<?php

namespace App\Http\Controllers\catalogo;

use App\Http\Controllers\Controller;
use App\Models\catalogo\Categoria;
use App\Models\catalogo\Estado;
use App\Models\catalogo\TipoPregunta;
use App\Models\cursos\Archivo;
use App\Models\cursos\Curso;
use App\Models\cursos\Examen;
use App\Models\cursos\Respuesta;
use App\Models\cursos\Tema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CursoControler extends Controller
{
    public function index()
    {
        $cursos = Curso::get();
        return view('catalogo.curso.index', compact('cursos'));
    }


    public function create()
    {
        $categorias = Categoria::where('activo', 1)->get();
        return view('catalogo.curso.create', compact('categorias'));
    }


    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|max:255',
            'categoria_id' => 'required|exists:categoria,id',
            'adjunto' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'descripcion' => 'required|max:500',
        ], [
            // Mensajes personalizados para cada campo
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'adjunto.nullable' => 'La imagen es opcional.',
            'adjunto.file' => 'El archivo de imagen debe ser un archivo válido.',
            'adjunto.mimes' => 'La imagen debe ser de tipo jpg, jpeg, png, gif o svg.',
            'adjunto.max' => 'El tamaño de la imagen no debe superar los 2MB.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);


        // Crear una nueva instancia de Curso
        $curso = new Curso();
        $curso->nombre = strtoupper(trim($request->nombre));
        $curso->categoria_id = $request->categoria_id;
        $curso->descripcion = strtoupper(trim($request->descripcion));

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('adjunto')) {

            $file = $request->file('adjunto');

            $uniqueId = (int)(microtime(true) * 1000000);

            // Obtener la extensión del archivo
            $extension = $file->getClientOriginalExtension();

            $imageName = $uniqueId . '.' . $extension;

            $file->move(public_path('images/cursos'), $imageName);

            $curso->imagen =  $imageName;
        }

        $curso->save();

        alert()->success("Registro guardado correctamente");
        return Redirect('catalogo/curso');
    }

    public function show($id)
    {
        $curso = Curso::find($id);
        $tipos_pregunta = TipoPregunta::get();

        return view('catalogo.curso.show', compact('curso', 'tipos_pregunta'));
    }


    public function edit($id)
    {
        $curso = Curso::find($id);
        $categorias = Categoria::where('activo', 1)->get();
        $estados = Estado::get();
        return view('catalogo.curso.edit', compact('curso', 'categorias', 'estados'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'nombre' => 'required|max:255',
            'categoria_id' => 'required|exists:categoria,id',
            'adjunto' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'descripcion' => 'required|max:500',
        ], [
            // Mensajes personalizados para cada campo
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'adjunto.nullable' => 'La imagen es opcional.',
            'adjunto.file' => 'El archivo de imagen debe ser un archivo válido.',
            'adjunto.mimes' => 'La imagen debe ser de tipo jpg, jpeg, png, gif o svg.',
            'adjunto.max' => 'El tamaño de la imagen no debe superar los 2MB.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);


        // Crear una nueva instancia de Curso
        $curso = Curso::find($id);
        $curso->nombre = strtoupper(trim($request->nombre));
        $curso->categoria_id = $request->categoria_id;
        $curso->estado_id = $request->estado_id;
        $curso->descripcion = strtoupper(trim($request->descripcion));

        // Verificar si se ha enviado una imagen
        if ($request->hasFile('adjunto')) {

            $file = $request->file('adjunto');

            $uniqueId = (int)(microtime(true) * 1000000);

            // Obtener la extensión del archivo
            $extension = $file->getClientOriginalExtension();

            $imageName = $uniqueId . '.' . $extension;

            // Verificar si ya existe una imagen asociada al curso
            if ($curso->imagen) {
                // Eliminar la imagen existente
                $existingImagePath = public_path("images/cursos/" . $curso->imagen);
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath); // Eliminar la imagen del directorio
                }
            }

            $file->move(public_path('images/cursos'), $imageName);

            $curso->imagen =  $imageName;
        }

        $curso->update();

        alert()->success("Registro modificado correctamente");
        return Redirect('catalogo/curso');
    }

    public function destroy($id)
    {
        // Buscar el curso por ID
        $curso = Curso::find($id);

        // Validar si el curso existe
        if (!$curso) {
            alert()->error("El curso no existe o ya fue eliminado.");
            return redirect('catalogo/curso');
        }

        try {
            // Intentar eliminar el curso
            $curso->delete();
            alert()->success("Registro eliminado correctamente");
        } catch (\Illuminate\Database\QueryException $e) {
            // Capturar el error en caso de fallo de eliminación por restricción de clave foránea
            alert()->error("No se pudo eliminar el registro, ya que está relacionado con otros datos.");
        }

        return redirect('catalogo/curso');
    }


    public function upload(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'tema_id' => 'required|integer',
            'nombre' => 'required|file|mimes:pdf,doc,docx,zip,jpg,png'
        ]);

        // Obtener el archivo subido
        $file = $request->file('nombre');


        // Generar un nuevo nombre de archivo utilizando un ID único
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Mover el archivo a la carpeta public/archivos
        $file->move(public_path('archivos'), $filename);

        $archivo = new Archivo();
        $archivo->nombre = $filename;
        $archivo->tema_id = $request->tema_id;
        $archivo->save();

        return back();
    }

    public function delete_upload(Request $request)
    {
        // Validar que se haya proporcionado un ID
        $request->validate([
            'id' => 'required|integer'
        ]);

        // Buscar el archivo por ID
        $archivo = Archivo::find($request->id);

        if ($archivo) {
            // Obtener la ruta completa del archivo
            $file_path = public_path('archivos/' . $archivo->nombre);

            // Eliminar el archivo físico si existe
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Eliminar el registro de la base de datos
            $archivo->delete();

            return back()->with('success', 'Archivo eliminado exitosamente');
        } else {
            return back()->with('error', 'Archivo no encontrado');
        }
    }

    public function add_tema(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|integer',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], [
            'curso_id.required' => 'El campo curso_id es obligatorio.',
            'curso_id.integer' => 'El curso_id debe ser un número entero.',
            'nombre.required' => 'El nombre del tema es obligatorio.',
            'descripcion.required' => 'La descripcion del tema es obligatoria.',
        ]);

        $tema = new Tema();
        $tema->nombre = $request->nombre;
        $tema->curso_id = $request->curso_id;
        $tema->descripcion = $request->descripcion;
        $tema->save();

        alert()->success("Registro guardado correctamente.");
        return back();
        // Lógica adicional para agregar el tema
    }


    public function update_tema(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], [
            'id.required' => 'Tema no encontrado',
            'id.integer' => 'Tema no encontrado',
            'nombre.required' => 'El nombre del tema es obligatorio.',
            'descripcion.required' => 'La descripcion del tema es obligatoria.',
        ]);

        $tema = Tema::find($request->id);
        $tema->nombre = $request->nombre;
        $tema->descripcion = $request->descripcion;
        $tema->save();

        alert()->success("Registro guardado correctamente.");
        return back();
        // Lógica adicional para agregar el tema
    }


    public function delete_tema(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'curso_id.required' => 'Tema no encontrado.',
            'curso_id.integer' => 'Tema no encontrado.',
        ]);

        $tema = Tema::find($request->id);
        $tema->delete();

        alert()->success("Registro eliminado correctamente.");
        return back();
        // Lógica adicional para agregar el tema
    }


    public function add_examen(Request $request)
    {

        // Validar los datos enviados con mensajes personalizados
        $request->validate([
            'curso_id' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_final' => 'required|date|after:fecha_inicio',
        ], [
            'curso_id.required' => 'El campo curso_id es obligatorio.',
            'curso_id.integer' => 'El curso_id debe ser un número entero.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_final.required' => 'La fecha final es obligatoria.',
            'fecha_final.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_final.after' => 'La fecha final debe ser posterior a la fecha de inicio.',
        ]);

        //dd("guardar examen 2");

        $examen = new Examen();
        $examen->curso_id = $request->curso_id;
        $examen->descripcion = $request->descripcion;
        $examen->fecha_inicio = $request->fecha_inicio;
        $examen->fecha_final = $request->fecha_final;
        $examen->save();

        alert()->success("Registro guardado correctamente.");
        return back();
        // Lógica adicional para agregar el tema
    }


    public function show_examen($id)
    {
        $examen = Examen::find($id);
        $tipos = TipoPregunta::get();

        return view('catalogo.curso.examen', compact('examen', 'tipos'));
    }

    public function show_examen_student($id)
    {
        $examen = Examen::find($id);
        $curso = Curso::find($examen->curso_id);
        $tipos = TipoPregunta::get();

        return view('catalogo.curso.examen_student', compact('curso', 'examen', 'tipos'));
    }

    public function show_examen_evaluar(Request $request)
    {
        // Get all the input data from the request
        $data = $request->all();

        // Use array_filter to count the "on" values
        $onCount = count(array_filter($data, function ($value) {
            return $value === 'on';
        }));

        // Initialize counter
        $count_ok = 0;

        // Loop through each item in the request data
        foreach ($data as $key => $value) {
            // Check if the key starts with 'test' and the value is '1'
            if (strpos($key, 'test') === 0 && $value === '1') {
                $count_ok++;
            }
        }

        if ($count_ok < 6) {
            $mensaje = 'Lo Sentimos, necesita repetir este curso...!!';
        } else {
            $mensaje = 'Felicidades, puede inscribirse en el siguiente curso...!!';
        }


        return view('mensaje', compact('onCount', 'count_ok','mensaje'));

        //dd($onCount, $count_ok);
    }

    public function countOnValues(Request $request)
    {
        // Get all the input data from the request
        $data = $request->all();

        // Use array_filter to count the "on" values
        $onCount = count(array_filter($data, function ($value) {
            return $value === 'on';
        }));

        // You can now return the count or use it as needed
        return response()->json(['on_count' => $onCount]);
    }


    public function get_correcta($codigo)
    {

        $respuesta = Respuesta::find($codigo);

        return $respuesta['correcta'];
    }

    public function get_examenes($codigo)
    {
        //dd($codigo);
        $examenes = Examen::where('curso_id', $codigo)->get();

        return response()->json(
            $examenes,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );

        //dd($examenes);
        // $respuesta = Respuesta::find($codigo);

        // return $respuesta['correcta'];
    }



}
