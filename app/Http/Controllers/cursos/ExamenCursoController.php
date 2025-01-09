<?php

namespace App\Http\Controllers\cursos;

use App\Http\Controllers\Controller;
use App\Models\cursos\Pregunta;
use App\Models\cursos\Respuesta;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamenCursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {



        try {
            $pregunta = new Pregunta();
            $pregunta->descripcion = $request->descripcion;
            $pregunta->tipo_pregunta_id = $request->tipo_pregunta_id;
            $pregunta->examen_id = $request->examen_id;
            $pregunta->save();

            // if ($request->tipo_pregunta_id == 2) {
            //     $respuesta1 = new Respuesta();
            //     $respuesta1->pregunta_id = $pregunta->id;
            //     $respuesta1->descripcion = $request->respuesta1;
            //     $respuesta1->save();

            //     $respuesta2 = new Respuesta();
            //     $respuesta2->pregunta_id = $pregunta->id;
            //     $respuesta2->descripcion = $request->respuesta2;
            //     $respuesta2->save();
            // }

            $option_selected_correct = $request->option_selected_correct;
            $number = substr($option_selected_correct, strcspn($option_selected_correct, '0123456789'));
            $option_selected_correct_index =  $number;






            if (
                $request->tipo_pregunta_id == 2 ||
                $request->tipo_pregunta_id == 3 ||
                $request->tipo_pregunta_id == 4
            ) {

                foreach ($request->all() as $key => $value) {

                    if (strpos($key, 'option') === 0) { // Verificar si el nombre del campo empieza con 'option'
                        $number_option_selected = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                    }

                }

                // Obtener todas las respuestas dinámicas
                foreach ($request->all() as $key => $value) {

                    if (strpos($key, 'respuesta') === 0) { // Verificar si el nombre del campo empieza con 'respuesta'
                        $number_respuesta_selected = filter_var($key, FILTER_SANITIZE_NUMBER_INT);

                        if ($number_option_selected ==  $number_respuesta_selected) {
                            $respuesta = new Respuesta();
                            $respuesta->pregunta_id = $pregunta->id;
                            $respuesta->descripcion = $value;
                            $respuesta->correcta = '1';
                            $respuesta->save();
                        } else {
                            $respuesta = new Respuesta();
                            $respuesta->pregunta_id = $pregunta->id;
                            $respuesta->descripcion = $value;
                            //$respuesta->correcta = '0';
                            $respuesta->save();
                        }
                    }
                }
            }




            // Retornar la respuesta JSON con los datos recuperados
            return response()->json([
                'success' => true,
                'message' => 'Datos recibidos correctamente',
            ]);
        } catch (Exception $e) {
            // Manejar errores y retornar respuesta JSON con el error
            return response()->json([
                'success' => false,
                'message' => 'Hubo un problema al guardar los datos',
                'error' => $e->getMessage()
            ], 500); // Código de estado HTTP 500 para errores del servidor
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {


            return view('catalogo.curso.respuesta', compact('id'));
        } catch (\Exception $e) {
            // Devolver respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'Examen no encontrado',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
