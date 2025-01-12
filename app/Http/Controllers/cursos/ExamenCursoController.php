<?php

namespace App\Http\Controllers\cursos;

use App\Http\Controllers\Controller;
use App\Models\cursos\ExamenCurso;
use App\Models\cursos\ExamenCursoResultado;
use App\Models\cursos\Pregunta;
use App\Models\cursos\Respuesta;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ExamenCursoController extends Controller
{

    public function index()
    {
        $examen = ExamenCurso::where('user_id', auth()->user()->id)->where('finalizado', 1)->first();
        if ($examen) {
            // $preguntas = Pregunta::get();
            // $resultado80 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->first();
            // $respuesta80 = $resultado80->respuesta_text;

            // $resultado85 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->first();
            // $respuesta85 = $resultado85->audio;

            $fecha_examen_fin = ExamenCurso::where('user_id', auth()->user()->id)
                    ->where('finalizado', 1)
                    ->pluck('fecha');

                    $fecha = $fecha_examen_fin[0]; // Fecha original
                    $fecha_formateada = date("d/m/Y H:i:s", strtotime($fecha));




            return view('examen.index', compact('fecha_formateada'));
        }
        return redirect()->route('curso.examen.section', ['number' => 1]);
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

        $titleArray = ['', 'Structure', 'Reading', 'Structure', 'Reading', 'Structure', 'Reading', 'Listening', '', ''];
        $descriptionArray = [
            '',
            'Click on the best word or phrase (a, b, c or d) to fill each blank.',
            'Read the text below. For questions 21 to 25, choose the best answer (a, b, c or d). In 1895, the well-known scientist Lord Kelvin said, "Heavier than air flying machines are impossible." Kelvin was wrong. In 1943, Thomas Watson, the chairman of International Business Machines (IBM) was also wrong when he said that he thought there would be a world market for only five or so computers. Predictions can be wrong, and it is very difficult to predict what the world will be like in 100, 50, or even 20 years. But this is something that scientists and politicians often do. They do so because they invent things and make decisions that shape the future of the world that we live in. In the past they didn’t have to think too much about the impact that their decisions had on the natural world. But that is now changing. More and more people believe that we should live within the rules set by nature. In other words, they think that in a world of fixed and limited resources, what is used up today will no longer be available for our children. We need to look at each human activity and try to change it or create alternatives if it is not sustainable. The rules for this are set by nature, not by man.',
            'Click on the best word or phrase (a, b, c or d) to fill each blank.',
            'Read the text below. For questions 46 to 50, choose the best answer (a, b, c or d). Many hotel chains and tour operators say that they take their environmental commitments seriously, but often they do not respect their social and economic responsibilities to the local community. So is it possible for travellers to help improve the lives of locals and still have a good holiday? The charity, Tourism Concern, thinks so. It has pioneered the concept of the fair-trade holiday. The philosophy behind fair-trade travel is to make sure that local people get a fair share of the income from tourism. The objectives are simple: employing local people wherever possible; offering fair wages and treatment; showing cultural respect; involving communities in deciding how tourism is developed; and making sure that visitors have minimal environmental impact. Although there is currently no official fair-trade accreditation for holidays, the Association of Independent Tour Operators has worked hard to produce responsible tourism guidelines for its members. Some new companies, operated as much by principles as profits, offer a fantastic range of holidays for responsible and adventurous travellers.',
            'Click on the best word or phrase (a, b, c or d) to fill each blank.',
            'Read the text below. For questions 71 to 76, choose the best answer (a, b, c or d). Standards of spelling and grammar among an entire generation of English-speaking university students are now so poor that there is ‘a degree of crises in their written use of the language, the publisher of a new dictionary has warned. Its research revealed that students have only a limited grasp of the most basic rules of spelling, punctuation and meaning, blamed in part on an increasing dependence on ‘automatic tools’ such as computer spellcheckers and unprecedented access to rapid communication using e-mail and the Internet. The problem is not confined to the US, but applies also to students in Australia, Canada and Britain. Students were regularly found to be producing incomplete or rambling, poorly connected sentences, mixing metaphors ‘with gusto’ and overusing dull, devalued words such as ‘interesting’ and ‘good’. Overall they were unclear about appropriate punctuation, especially the use of commas, and failed to understand the basic rules of subject/verb agreement and the difference between ‘there’, ‘their’ and ‘they’re’. Kathy Rooney, editor-in-chief of the dictionary, said, ‘We need to be very concerned at the extent of the problems with basic spelling and usage that our research has revealed. This has significant implications for the future, especially for young people. We thought it would be useful to get in touch with teachers and academics to find out what problems their students were having with their writing and what extra help they might need from a dictionary. The results were quite shocking. We are sure that the use of computers has played a part. People rely increasingly on automatic tools such as spellcheckers that are much more passive than going to a dictionary and looking something up. That can lull them into a false sense of security.’ Beth Marshall, an English professor, said, ‘The type of student we’re getting now is very different from what we were seeing 10 years ago and it is often worrying to find out how little students know. There are as many as 800 commonly misspelled words, particularly pairs of words that are pronounced similarly but spelled differently and that have different meanings – for example, “faze” and “phase”, and “pray” and “prey”.’',
            '<strong>Listening part.</strong><br> For each question, you will hear a short sentence. The sentence will be spoken just one time. The sentences you hear will not be written out for you. After you hear each sentence, read the 4 choices on the screen and decide which one is closest in meaning to the sentence you heard. Then select the best answer by clicking on it.',
            '',
            ''
        ];
        $progressArray = [0, 5, 24, 29, 53, 59, 82, 89, 94, 97];
        $progress = $progressArray[$section];
        $title = $titleArray[$section];
        $description = $descriptionArray[$section];
        if ($section == 1) {
            $preguntas = Pregunta::whereBetween('id', [1, 20])->get();
        } else if ($section == 2) {
            $preguntas = Pregunta::whereBetween('id', [21, 25])->get();
        } else if ($section == 3) {
            $preguntas = Pregunta::whereBetween('id', [26, 45])->get();
        } else if ($section == 4) {
            $preguntas = Pregunta::whereBetween('id', [46, 50])->get();
        } else if ($section == 5) {
            $preguntas = Pregunta::whereBetween('id', [51, 70])->get();
        } else if ($section == 6) {
            $preguntas = Pregunta::whereBetween('id', [71, 76])->get();
        } else if ($section == 7) {
            $audios_array = ["audio77.mp3", "audio77.mp3", "audio77.mp3",];
            $preguntas = Pregunta::whereBetween('id', [77, 79])->get();
            return view('examen.section', compact('preguntas', 'section', 'progress', 'audios_array', 'title', 'description'));
        } else if ($section == 8) {
            $pregunta = Pregunta::where('id', [80])->first();

            $examen = ExamenCurso::where('user_id', auth()->user()->id)->first();
            $resultado = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->first();

            return view('examen.section_8', compact('pregunta', 'resultado', 'progress', 'title', 'description'));
        } else if ($section == 9) {
            $pregunta = Pregunta::where('id', [85])->first();
            return view('examen.section_final', compact('pregunta', 'section', 'progress', 'title', 'description'));
        }

        return view('examen.section', compact('preguntas', 'section', 'progress', 'title', 'description'));
    }
    public function store_section(Request $request)
    {
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
            [85, 85]   // Sección 9
        ];


        //aca se crear o se busca el registro segun el caso
        $examen = ExamenCurso::firstOrCreate(
            ['user_id' => auth()->user()->id], // Condición de búsqueda
            [
                // Datos a insertar si no existe
                'user_id' => auth()->user()->id
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

        return redirect()->route('curso.examen.section', ['number' => $section]);
    }

    public function store_section8(Request $request)
    {

        $examen = ExamenCurso::where('user_id', auth()->user()->id)->first();

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
        $examen = ExamenCurso::where('user_id', auth()->user()->id)->first();

        $resultado = new ExamenCursoResultado();
        $resultado->examen_curso_id = $examen->id;
        $resultado->pregunta_id = 85;
        $resultado->audio = $request->audioData;
        $resultado->save();

        $examen->finalizado = 1;
        $examen->save();

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
            }

            $respuesta85 = "";
            $resultado85 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->first();
            if ($respuesta85) {
                $respuesta85 = $resultado85->audio;
            }


            $preguntas_seccion1 = Pregunta::whereBetween('id', [1, 20])->get();
            $preguntas_seccion2 = Pregunta::whereBetween('id', [21, 25])->get();
            $preguntas_seccion3 = Pregunta::whereBetween('id', [26, 45])->get();
            $preguntas_seccion4 = Pregunta::whereBetween('id', [46, 50])->get();
            $preguntas_seccion5 = Pregunta::whereBetween('id', [51, 70])->get();
            $preguntas_seccion6 = Pregunta::whereBetween('id', [71, 76])->get();
            $preguntas_seccion7 = Pregunta::whereBetween('id', [77, 79])->get();
            $preguntas_seccion8 = Pregunta::whereBetween('id', [80, 80])->get();
            //$preguntas_seccion9 = Pregunta::whereBetween('id', [85, 85])->get();


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

                $pdf = Pdf::loadView(
                    'examen.reporte_pdf',
                    [
                        'examen' => $examen,
                        'preguntas' => $preguntas,
                        'respuesta80' => $respuesta80,
                        'respuesta85' => $respuesta85,
                        'exportar' => $exportar,
                        'preguntas_seccion1' => $preguntas_seccion1,
                        'preguntas_seccion2' => $preguntas_seccion2,
                        'preguntas_seccion3' => $preguntas_seccion3,
                        'preguntas_seccion4' => $preguntas_seccion4,
                        'preguntas_seccion5' => $preguntas_seccion5,
                        'preguntas_seccion6' => $preguntas_seccion6,
                        'preguntas_seccion7' => $preguntas_seccion7,
                        'preguntas_seccion8' => $preguntas_seccion8
                    ]
                );
                return $pdf->download('invoice.pdf');
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

        $number_words = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->value('number_words');
        $respuesta_text = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->value('respuesta_text');

        $audio_actual = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->where('audio_actual', 1)->value('audio');

        // $examen_curso_seccion8 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 80)->get();

        // $examen_curso_seccion9 = ExamenCursoResultado::where('examen_curso_id', $examen->id)->where('pregunta_id', 85)->where('audio_actual', 1)->get();

        $pregunta_seccion8 = Pregunta::where('id', 80)->value('descripcion');
        $pregunta_seccion9 = Pregunta::where('id', 85)->value('descripcion');

        return response()->json([

            'pregunta_seccion8' => $pregunta_seccion8,
            'number_words' => $number_words,
            'respuesta_text' => $respuesta_text,
            'pregunta_seccion9' => $pregunta_seccion9,
            'audio_actual' => $audio_actual,
        ]);

    }
}
