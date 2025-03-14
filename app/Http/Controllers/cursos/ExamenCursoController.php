<?php

namespace App\Http\Controllers\cursos;

use App\Http\Controllers\Controller;
use App\Models\cursos\ExamenCurso;
use App\Models\cursos\ExamenCursoResultado;
use App\Models\cursos\Pregunta;
use App\Models\cursos\Respuesta;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ExamenCursoController extends Controller
{

    public function index(Request $request)
    {
        //dd(session('id'), $request->mensaje);
        if ($request->mensaje == "fin") {
            if (session('id') == '1') {
                session()->flush();
                return Redirect::to('login/1');
            } else {
                session()->flush();
                return Redirect::to('login/2');
            }
        } else {

            if (session('id') == '1') {
                $examen = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 1)->where('finalizado', 1)->first();

                if ($examen) {

                    $fecha_examen_fin = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 1)
                        ->where('finalizado', 1)
                        ->pluck('fecha');

                    $fecha = $fecha_examen_fin[0]; // Fecha original
                    $fecha_formateada = date("d/m/Y H:i:s", strtotime($fecha));




                    return view('examen.index', compact('fecha_formateada'));
                }
            } else {
                $examen = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 2)->where('finalizado', 1)->first();

                if ($examen) {

                    $fecha_examen_fin = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 2)
                        ->where('finalizado', 1)
                        ->pluck('fecha');

                    $fecha = $fecha_examen_fin[0]; // Fecha original
                    $fecha_formateada = date("d/m/Y H:i:s", strtotime($fecha));




                    return view('examen.index', compact('fecha_formateada'));
                }
            }

            return redirect()->route('curso.examen.section', ['number' => 1]);
        }
    }

    public function index_admin()
    {
        $examenes = ExamenCurso::get();

        return view('examen.index_admin', compact('examenes'));
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
        //aca se crear o se busca el registro segun el caso
        $examen = ExamenCurso::firstOrCreate(
            ['user_id' => auth()->user()->id] // Criterios para buscar el registro
        );

        // Obtener todas las respuestas que comienzan con "respuesta_"
        $respuestas = $request->all();

        // Filtrar solo las claves que comienzan con "respuesta_"
        $respuestas = array_filter($respuestas, function ($key) {
            return strpos($key, 'respuesta_') === 0; // Verifica que la clave comience con "respuesta_"
        }, ARRAY_FILTER_USE_KEY);

        // Recorrer todas las respuestas
        foreach ($respuestas as $key => $respuesta) {
            // Extraer el número de la pregunta desde el nombre de la clave (ejemplo "respuesta_1")
            $numeroPregunta = str_replace('respuesta_', '', $key);

            $resultado = ExamenCursoResultado::updateOrCreate(
                [
                    'examen_curso_id' => $examen->id,
                    'pregunta_id' => $numeroPregunta,
                    'respuesta_id' => $respuesta
                ],
                [
                    'pregunta_id' => $numeroPregunta,
                    'respuesta_id' => $respuesta
                ]
            );
        }

        return redirect()->route('curso.examen.section', ['number' => 2]);
    }

    public function show_section($section)
    {

        if (session('id') == 1) { //examen de ingles
            $titleArray = ['', 'Structure', 'Reading', 'Structure', 'Reading', 'Structure', 'Reading', 'Listening', '', ''];
            $descriptionArray = [
                '',
                'Choose the right answer to fill each blank.',
                'Read the text below. For questions 21 to 25, choose the right answer. <br><br>
<div class="table-responsive">
    <table class="table">
        <tr>
            <td style="text-align: center;">
                <img class="responsive" src="https://cursos.coopweb.info/public/assets/audio/test_reading_section2.PNG" style="max-width: 100%; height: auto;" />
            </td>
        </tr>
    </table>
</div>


                ',
                'Choose the right answer to fill each blank.',
                'Read the text below. For questions 46 to 50, choose the right answer. <br><br>Many hotel chains and tour operators say that they take their environmental commitments seriously, but often they do not respect their social and economic responsibilities to the local community. So is it possible for travelers to help improve the lives of locals and still have a good holiday? The charity, Tourism Concern, thinks so. It has pioneered the concept of the fair-trade holiday. <br><br>The philosophy behind fair-trade travel is to make sure that local people get a fair share of the income from tourism. The objectives are simple: employing local people wherever possible; offering fair wages and treatment; showing cultural respect; involving communities in deciding how tourism is developed; and making sure that visitors have minimal environmental impact. <br><br>Although there is currently no official fair-trade accreditation for holidays, the Association of Independent Tour Operators has worked hard to produce responsible tourism guidelines for its members. Some new companies, operated as much by principles as profits, offer a fantastic range of holidays for responsible and adventurous travelers.',
                'Choose the right answer to fill each blank.',
                'Read the text below. For questions 71 to 76, choose the right answer. <br><br>
                 <div class="table-responsive">
<div class="table-responsive">
    <table class="table">
        <tr>
            <td style="text-align: center;">
                <img class="responsive" src="https://cursos.coopweb.info/public/assets/audio/test_reading_section6.PNG" style="max-width: 100%; height: auto;" />
            </td>
        </tr>
    </table>
</div>
                ',
                '<strong>Listening section.</strong><br> For each question, you will hear a short sentence. The sentence will be spoken just one time. The sentences you hear will not be written out for you. <br>After you hear each sentence, read the 4 choices on the screen and decide which one is closest in meaning to the sentence you heard. Then select the best answer by clicking on it.',
                '',
                ''
            ];
        } else { //examen vocacional
            $titleArray = ['', 'TABLA 1 C', 'TABLA 2 H', 'TABLA 3 A', 'TABLA 4 S', 'TABLA 5 I', 'TABLA 6 D', 'TABLA 7 E', '', ''];
            $descriptionArray = [
                '',
                'Indicaciones: <br> Por favor lea las preguntas con atención y luego marque solamente si su respuesta es afirmativa.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                'Indicaciones: <br> Por favor lea las declaraciones con atención y luego marque solamente las que reflejen su personalidad.',
                '',
                ''
            ];
        }



        $progressArray = [0, 5, 24, 29, 53, 59, 82, 89, 94, 97];
        $progress = $progressArray[$section];
        $title = $titleArray[$section];
        $description = $descriptionArray[$section];


        if (session('id') == 1) { // examen ingles


            if ($section == 1) {
                $preguntas = Pregunta::whereBetween('id', [1, 20])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 2) {
                $preguntas = Pregunta::whereBetween('id', [21, 25])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 3) {
                $preguntas = Pregunta::whereBetween('id', [26, 45])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 4) {
                $preguntas = Pregunta::whereBetween('id', [46, 50])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 5) {
                $preguntas = Pregunta::whereBetween('id', [51, 70])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 6) {
                $preguntas = Pregunta::whereBetween('id', [71, 76])->where('clase_pregunta_id', 1)->get();
            } else if ($section == 7) {
                $audios_array = ["audio77.mp3", "audio77.mp3", "audio77.mp3",];
                $preguntas = Pregunta::whereBetween('id', [77, 79])->where('clase_pregunta_id', 1)->get();
                return view('examen.section', compact('preguntas', 'section', 'progress', 'audios_array', 'title', 'description'));
            } else if ($section == 8) {
                $pregunta = Pregunta::where('id', [80])->where('clase_pregunta_id', 1)->first();

                $examen = ExamenCurso::where('user_id', session('user_id'))->first();
                $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->first();

                return view('examen.section_8', compact('pregunta', 'resultado', 'progress', 'title', 'description'));
            } else if ($section == 9) {
                $pregunta = Pregunta::where('id', [81])->where('clase_pregunta_id', 1)->first();
                return view('examen.section_final', compact('pregunta', 'section', 'progress', 'title', 'description'));
            }
        } else {    //examen vocacional


            if ($section == 1) {
                $preguntas = Pregunta::whereBetween('id', [82, 95])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 2) {
                $preguntas = Pregunta::whereBetween('id', [96, 109])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 3) {
                $preguntas = Pregunta::whereBetween('id', [110, 123])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 4) {
                $preguntas = Pregunta::whereBetween('id', [124, 137])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 5) {
                $preguntas = Pregunta::whereBetween('id', [138, 151])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 6) {
                $preguntas = Pregunta::whereBetween('id', [152, 165])->where('clase_pregunta_id', 2)->get();
            } else if ($section == 7) {
                $preguntas = Pregunta::whereBetween('id', [166, 179])->where('clase_pregunta_id', 2)->get();

                return view('examen.section', compact('preguntas', 'section', 'progress', 'title', 'description'));
            } else if ($section == 8) {
                //dd("finalizar examen vocacional");



                //dd($request->audioData);
                $examen = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 2)->first();

                // $resultado = new ExamenCursoResultado();
                // $resultado->examen_curso_id = $examen->id;
                // $resultado->pregunta_id = 81;
                // $resultado->audio = $request->audioData;
                // $resultado->save();

                $examen->finalizado = 1;
                $examen->save();

                return Redirect::to('curso/examen');
            }
        }



        return view('examen.section', compact('preguntas', 'section', 'progress', 'title', 'description'));
    }
    public function store_section(Request $request)
    {
        //dd(session('id'));

        //aca se crear o se busca el registro segun el caso
        // Determinar el valor de clase_pregunta_id según la condición
        $clasePreguntaId = session('id') == '1' ? 1 : 2;

        // Crear o buscar el registro con firstOrCreate
        $examen = ExamenCurso::firstOrCreate(
            ['user_id' => session('user_id')], // Condición de búsqueda
            [
                'user_id' => session('user_id'),
                'clase_pregunta_id' => $clasePreguntaId,
            ]
        );


        if ($clasePreguntaId == 1) { //EXAMEN INGLES

            $section = $request->section;

            $preguntasSeccionArray = [
                [0, 0],    // Sección inicial (opcional)
                [1, 20],   // Sección 1
                [21, 25],  // Sección 2
                [26, 45],  // Sección 3
                [46, 50],  // Sección 4
                [51, 70],  // Sección 5
                [71, 76],  // Sección 6
                [77, 79],  // Sección 7
                [80, 80],  // Sección 8
                [81, 81]   // Sección 9
            ];

            //aca se crear o se busca el registro segun el caso
            // Determinar el valor de clase_pregunta_id según la condición
            $clasePreguntaId = session('id') == '1' ? 1 : 2;

            // Crear o buscar el registro con firstOrCreate
            $examen = ExamenCurso::firstOrCreate(
                ['user_id' => session('user_id')], // Condición de búsqueda
                [
                    'user_id' => session('user_id'),
                    'clase_pregunta_id' => $clasePreguntaId,
                ]
            );



            $indices = $preguntasSeccionArray[$request->section];



            for ($i = $indices[0]; $i <= $indices[1]; $i++) {
                $respuestaPost = "respuesta_" . $i;

                if ($request->$respuestaPost) {
                    $respuesta = Respuesta::find($request->$respuestaPost);

                    $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', $i)->first();
                    if (!$resultado) {
                        $resultado = new ExamenCursoResultado();
                    }

                    $resultado->examen_curso_id = $examen->id;
                    $resultado->pregunta_id = $i;

                    if ($respuesta) {
                        $resultado->respuesta_id = $request->$respuestaPost;
                        $resultado->correcta = $respuesta->correcta;
                    }
                    $resultado->save();
                } else {
                    $respuesta = Respuesta::find($request->$respuestaPost);

                    $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', $i)->first();
                    if (!$resultado) {
                        $resultado = new ExamenCursoResultado();
                    }

                    $resultado->examen_curso_id = $examen->id;
                    $resultado->pregunta_id = $i;
                    $resultado->save();
                }
            }

            $section++;
        } else { //EXAMEN VOCACIONAL


            $section = $request->section;



            $preguntasSeccionArray = [
                [0, 0],    // Sección inicial (opcional)
                [82, 95],    // Sección 1
                [96, 109],   // Sección 2
                [110, 123],  // Sección 3
                [124, 137],  // Sección 4
                [138, 151],  // Sección 5
                [152, 165],  // Sección 6
                [166, 179],  // Sección 7

            ];





            $indices = $preguntasSeccionArray[$request->section];

            //dd($section, $indices, $indices[0], $indices[1]);

            for ($i = $indices[0]; $i <= $indices[1]; $i++) {
                $respuestaPost = "respuesta_" . $i;

                //dd($respuestaPost);

                if ($request->$respuestaPost) {
                    $respuesta = Respuesta::find($request->$respuestaPost);

                    $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', $i)->first();
                    if (!$resultado) {
                        $resultado = new ExamenCursoResultado();
                    }

                    $resultado->examen_curso_id = $examen->id;
                    $resultado->pregunta_id = $i;

                    if ($respuesta) {
                        $resultado->respuesta_id = $request->$respuestaPost;
                        $resultado->correcta = $respuesta->correcta;
                    }
                    $resultado->save();
                } else {
                    $respuesta = Respuesta::find($request->$respuestaPost);

                    $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', $i)->first();
                    if (!$resultado) {
                        $resultado = new ExamenCursoResultado();
                    }

                    $resultado->examen_curso_id = $examen->id;
                    $resultado->pregunta_id = $i;
                    $resultado->save();
                }
            }

            $section++;
        }



        return redirect()->route('curso.examen.section', ['number' => $section]);
    }

    public function store_section8(Request $request)
    {

        $examen = ExamenCurso::where('user_id', session('user_id'))->first();

        $resultado = ExamenCursoResultado::firstOrNew(
            ['examen_curso_id' => $examen->id, 'pregunta_id' => 80]
        );

        $resultado->respuesta_text = $request->respuesta_80;
        $resultado->save();

        return redirect()->route('curso.examen.section', ['number' => 9]);
    }

    public function store_section_final(Request $request)
    {

        //dd($request->audioData);
        //$examen = ExamenCurso::where('user_id', session('user_id'))->first();
        $examen = ExamenCurso::where('user_id', session('user_id'))->where('clase_pregunta_id', 1)->first();

        $resultado = new ExamenCursoResultado();
        $resultado->examen_curso_id = $examen->id;
        $resultado->pregunta_id = 81;
        $resultado->audio = $request->audioData;
        $resultado->save();

        $examen->finalizado = 1;
        $examen->save();

        session(['final' => '1']); //finalize el examen

        return Redirect::to('curso/examen');
    }

    public function show($id, Request $request)
    {

        $examen = ExamenCurso::find($id);
        if ($examen) {
            $preguntas = Pregunta::get();
            $resultado80 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->first();
            $respuesta80 = "";
            if ($resultado80) {
                $respuesta80 = $resultado80->respuesta_text;
                $observacion_seccion8 = $resultado80->observacion_seccion8;

                if ($observacion_seccion8 == null) {
                    $observacion_seccion8 = "";
                }

                $puntos_seccion8 = $resultado80->puntos_seccion8;
            }

            $respuesta85 = "";
            $resultado85 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 81)->first();


            if ($resultado85) {
                $respuesta85 = $resultado85->audio;
                $observacion_seccion9 = $resultado85->observacion_seccion9;
                $puntos_seccion9 = $resultado85->puntos_seccion9;
            }


            $preguntas_seccion1 = Pregunta::whereBetween('id', [1, 20])->get();
            $preguntas_seccion2 = Pregunta::whereBetween('id', [21, 25])->get();
            $preguntas_seccion3 = Pregunta::whereBetween('id', [26, 45])->get();
            $preguntas_seccion4 = Pregunta::whereBetween('id', [46, 50])->get();
            $preguntas_seccion5 = Pregunta::whereBetween('id', [51, 70])->get();
            $preguntas_seccion6 = Pregunta::whereBetween('id', [71, 76])->get();
            $preguntas_seccion7 = Pregunta::whereBetween('id', [77, 79])->get();
            $preguntas_seccion8 = Pregunta::whereBetween('id', [80, 80])->get();
            $preguntas_seccion9 = Pregunta::whereBetween('id', [81, 81])->get();


            $exportar = 0;

            // Verifica si se desea exportar el reporte
            if ($request->has('exportar') && $request->exportar == 1) {
                $exportar = 1;


                        /*   return view('examen.reporte_pdf', compact('examen', 'preguntas', 'respuesta80', 'respuesta85', 'exportar', 'preguntas_seccion1',
                    'preguntas_seccion2',
                    'preguntas_seccion3',
                    'preguntas_seccion4',
                    'preguntas_seccion5',
                    'preguntas_seccion6',
                    'preguntas_seccion7',
                    'preguntas_seccion8'));*/

                    if (!isset($observacion_seccion8)) {
                        $observacion_seccion8 = '';
                        $puntos_seccion8 = 0;
                        $respuesta80 = '';
                    }


                    if (!isset($observacion_seccion9)) {
                        $observacion_seccion9 = '';
                        $puntos_seccion9 = 0;
                        $respuesta85= '';
                    }


                //dd($examen->usuario->id, $examen->usuario->name  );
                $user = User::findorFail($examen->usuario->id);
                $user->impreso = 1;
                $user->eliminado = 0;
                $user->update();


                $pdf = Pdf::loadView(
                    'examen.reporte_pdf',
                    [
                        'examen' => $examen,
                        'preguntas' => $preguntas,
                        'respuesta80' => $respuesta80,
                        'observacion_seccion8' => $observacion_seccion8,
                        'puntos_seccion8' => $puntos_seccion8,
                        'respuesta85' => $respuesta85,
                        'observacion_seccion9' => $observacion_seccion9,
                        'puntos_seccion9' => $puntos_seccion9,
                        'exportar' => $exportar,
                        'preguntas_seccion1' => $preguntas_seccion1,
                        'preguntas_seccion2' => $preguntas_seccion2,
                        'preguntas_seccion3' => $preguntas_seccion3,
                        'preguntas_seccion4' => $preguntas_seccion4,
                        'preguntas_seccion5' => $preguntas_seccion5,
                        'preguntas_seccion6' => $preguntas_seccion6,
                        'preguntas_seccion7' => $preguntas_seccion7,
                        'preguntas_seccion8' => $preguntas_seccion8,
                        'preguntas_seccion9' => $preguntas_seccion9
                    ]
                );
                return $pdf->download('examen.pdf');
            }

            if ($request->has('exportar') && $request->exportar == 2) {
                //dd("eliminar este usuario");
                $user = User::findorFail($examen->usuario->id);
                $user->eliminado = 1;
                $user->update();
            }



            return view('examen.index', compact('examen', 'preguntas', 'respuesta80', 'respuesta85', 'exportar'));
        }

        /*try {


            return view('catalogo.curso.respuesta', compact('id'));
        } catch (\Exception $e) {
            // Devolver respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'Examen no encontrado',
            ], 404);
        }*/
    }


    public function finalizado()
    {
        $examen = ExamenCurso::firstOrCreate(
            ['user_id' => auth()->user()->id], // Condición de búsqueda
            [
                // Datos a insertar si no existe
                'user_id' => auth()->user()->id
            ]
        );

        $preguntas = Pregunta::get();

        foreach ($preguntas as $pregunta) {
            $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', $pregunta->id)->first();
            if (!$resultado) {
                $resultado = new ExamenCursoResultado();
                $resultado->examen_curso_id = $examen->id;
                $resultado->pregunta_id = $pregunta->id;
                $resultado->save();
            }
        }

        $examen->finalizado = 1;
        $examen->save();
        return Redirect::to('curso/examen');
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


    public function get_sections_89($id)
    {
        $examen = ExamenCurso::where('user_id', $id)->where('finalizado', 1)->first();

        $section8_id = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->value('id');
        $number_words = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->value('number_words');
        $respuesta_text = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->value('respuesta_text');

        $section9_id = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 81)->value('id');
        $audio_actual = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 81)->value('audio');

        // $examen_curso_seccion8 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->get();

        // $examen_curso_seccion9 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->where('audio_actual', 1)->get();

        $pregunta_seccion8 = Pregunta::where('id', 80)->value('descripcion');
        $pregunta_seccion9 = Pregunta::where('id', 81)->value('descripcion');

        return response()->json([
            'section8_id' => $section8_id,
            'pregunta_seccion8' => $pregunta_seccion8,
            'number_words' => $number_words,
            'respuesta_text' => $respuesta_text,
            'section9_id' => $section9_id,
            'pregunta_seccion9' => $pregunta_seccion9,
            'audio_actual' => $audio_actual,
        ]);
    }

    public function evaluate_section89(Request $request)
    {
        $seccion8_id = $request->get('seccion8_id');
        $observations_section8 = $request->get('observations_section8');
        $points80 = $request->get('points80');


        $exam_res8 = ExamenCursoResultado::findOrFail($seccion8_id);
        $exam_res8->observacion_seccion8 = $observations_section8;
        $exam_res8->puntos_seccion8 = $points80;
        $exam_res8->update();

        $seccion9_id = $request->get('seccion9_id');
        $observations_section9 = $request->get('observations_section9');
        $points85 = $request->get('points85');

        $exam_res9 = ExamenCursoResultado::findOrFail($seccion9_id);
        $exam_res9->observacion_seccion9 = $observations_section9;
        $exam_res9->puntos_seccion9 = $points85;
        $exam_res9->update();



        $examen = ExamenCurso::find($exam_res8->examen_curso_id);

        $user = User::findorFail($examen->usuario->id);
        $user->calificado = 1;
        $user->update();

        alert()->success("Seccion 8 y 9 calificada correctamente");
        return Redirect('curso/examen/admin');
    }
}
