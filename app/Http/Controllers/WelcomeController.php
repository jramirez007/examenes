<?php

namespace App\Http\Controllers;

use App\Models\catalogo\Categoria;
use App\Models\cursos\Curso;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $cursos = Curso::get();
        $categorias = Categoria::get();
        return view('welcome', compact('cursos','categorias'));
    }
}
