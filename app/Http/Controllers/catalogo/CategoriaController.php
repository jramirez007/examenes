<?php

namespace App\Http\Controllers\catalogo;

use App\Http\Controllers\Controller;
use App\Models\catalogo\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::get();
        return view('catalogo.categoria.index', compact('categorias'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:categoria,nombre',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'nombre.unique' => 'El nombre ya existe en la base de datos.',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = trim($request->nombre);
        $categoria->activo = 1;
        $categoria->save();

        alert()->success("Registro guardado correctamente");
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:categoria,nombre,' . $id,
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.max' => 'El campo nombre no debe exceder los 255 caracteres.',
            'nombre.unique' => 'El nombre ya existe en la base de datos.',
        ]);

        //dd("aaa");

        $categoria = Categoria::find($id);
        $categoria->nombre = trim($request->nombre);
        $categoria->update();

        //dd("actualizado correctamente");

        alert()->success("Registro modificado correctamente");
        return back();
    }

    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['success' => false, 'message' => 'Categoría no encontrada.'], 404);
        }

        $categoria->activo = $request->activo;
        $categoria->save();

        // Retornar una respuesta JSON exitosa
        return response()->json(['success' => true, 'message' => 'Estado de la categoría actualizado correctamente.']);
    }
}
