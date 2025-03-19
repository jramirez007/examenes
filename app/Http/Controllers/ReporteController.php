<?php

namespace App\Http\Controllers;

use App\Models\catalogo\TipoPregunta;
use App\Models\cursos\Curso;
use App\Models\cursos\Examen;
use App\Models\cursos\ExamenCurso;
use App\Models\cursos\ExamenCursoResultado;
use App\Models\cursos\Pregunta;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    //

    public function index($id)
    {

        $examen = ExamenCurso::where('user_id', $id)->where('finalizado', 1)->first();

        //dd($examen);

        if ($examen) {
            $preguntas = Pregunta::get();
            $resultado80 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->first();
            $respuesta80 = $resultado80->respuesta_text;

            $resultado85 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->first();
            $respuesta85 = $resultado85->audio;

            return view('reporte.index', compact('examen', 'preguntas', 'respuesta80', 'respuesta85'));
        }

    }

    public function test(){
        dd("test");
    }
}
