<?php

namespace App\Http\Controllers;

use App\Models\cursos\Examen;
use App\Models\cursos\Curso;
use App\Models\catalogo\TipoPregunta;
use App\Models\cursos\Pregunta;
use App\Models\cursos\Respuesta;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function redirectToLogin()
     {
         return redirect('login');
     }

    public function index()
    {

        $user = User::find(auth()->user()->id);
        if($user->hasRole('administrador'))
        {
            return redirect('seguridad/usuario');
        }

        $examen = Examen::find(1);
        $curso = Curso::find($examen->curso_id);
        $tipos = TipoPregunta::get();

        $preguntas_seccion1 = Pregunta::whereBetween('id', [1, 20])->get();
        $preguntas_seccion2 = Pregunta::whereBetween('id', [21, 25])->get();
        $preguntas_seccion3 = Pregunta::whereBetween('id', [26, 45])->get();
        $preguntas_seccion4 = Pregunta::whereBetween('id', [46, 50])->get();
        $preguntas_seccion5 = Pregunta::whereBetween('id', [51, 70])->get();
        $preguntas_seccion6 = Pregunta::whereBetween('id', [71, 76])->get();
        $preguntas_seccion7 = Pregunta::whereBetween('id', [77, 79])->get();
        $preguntas_seccion8 = Pregunta::whereBetween('id', [80, 80])->get();
        $preguntas_seccion9 = Pregunta::whereBetween('id', [85, 85])->get();

        return view('home', compact(
            'curso',
            'examen',
            'preguntas_seccion1',
            'preguntas_seccion2',
            'preguntas_seccion3',
            'preguntas_seccion4',
            'preguntas_seccion5',
            'preguntas_seccion6',
            'preguntas_seccion7',
            'preguntas_seccion8',
            'preguntas_seccion9',
            'tipos'
        ));
    }

    public function upload_audio(Request $request)
    {


        if ($request->file('audioFile')) {
            $file = $request->file('audioFile');

            //dd($file);

            //$id_file = uniqid();

            $user_id = auth()->user()->id;

            if ($file) {
                try {
                    unlink(public_path("assets/audio/") . "recorded_audio" . $user_id . ".wav");
                } catch (Exception $e) {
                    //return $e->getMessage();
                }
            }

            // $file_path = public_path("assets/audio/") . $file->getClientOriginalName();
            // unlink($file_path);



            $file->move(public_path("assets/audio/"), "recorded_audio" . $user_id . ".wav");
            // Devolver una respuesta al usuario (puedes redirigir, o mostrar un mensaje)
            return back()->with('success', 'Archivo subido correctamente');
        }

        // Si ocurre algún error al cargar el archivo
        return back()->with('error', 'Hubo un error al cargar el archivo');
    }

    public function delete_audio(Request $request)
    {
        if ($request->file('audioFile')) {
            $file = $request->file('audioFile');
            $file_path = public_path("assets/audio/") . $file->getClientOriginalName();

            unlink($file_path);
            // Devolver una respuesta al usuario (puedes redirigir, o mostrar un mensaje)
            return back()->with('success', 'Archivo subido correctamente');
        }

        // Si ocurre algún error al cargar el archivo
        return back()->with('error', 'Hubo un error al cargar el archivo');
    }

    public function get_correcta($codigo)
    {

        $respuesta = Respuesta::find($codigo);

        return $respuesta['correcta'];
    }



    public function examen_evaluar(Request $request)
    {
        //dd("evaluar examen dede home");
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

        //dd($onCount, $count_ok);

        if ($count_ok < 6) {
            $mensaje = 'Lo Sentimos, necesita repetir este curso...!!';
        } else {
            $mensaje = 'Felicidades, puede inscribirse en el siguiente curso...!!';
        }

        $number_questions_total = 79;
        $number_questions_ok = $count_ok;
        $number_questions_bad = $number_questions_total - $count_ok;
        $number_questions_answered = $onCount;

        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $user->number_questions_total = $number_questions_total;
        $user->number_questions_ok = $number_questions_ok;
        $user->number_questions_bad = $number_questions_bad;
        $user->number_questions_answered = $number_questions_answered;
        $user->paragraph_section8 = $request->get('miTextarea');
        $user->audio_section9 = $request->get('audioData');
        //$user->audio_section9 = "recorded_audio" . $user_id . ".wav";
        $user->update();


        alert()->success("Felicidades has terminado tu examen de ingles");


        return back();

        //dd($onCount, $count_ok);
    }

    public function upload_audio_ok(Request $request)
    {



        $user_id = $request->get('user_id');
        $user = User::findOrFail($user_id);
        $user->audio_section9 = $request->get('audioData');
        $user->update();


        alert()->success("your audio has been saved successfully!!");


        return back();

        //dd($onCount, $count_ok);
    }

    public function upload_audio_ok2(){
        dd("hola");
    }
}
