<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\catalogo\TipoPregunta;
use App\Models\cursos\Curso;
use App\Models\cursos\Examen;
use App\Models\cursos\Pregunta;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login($id)
    {
        return view('auth.login', compact('id'));
    }

    public function process_login(Request $request)
    {
        //dd("process login");
        //dd($request->get('id'), $request->get('email'), $request->get('password'));

        $email = $request->get('email');
        $passwordInput = $request->get('password');

        // Retrieve the user by email
        $user = User::where('email', $email)->first();

        //dd($user);

        if ($user && Hash::check($passwordInput, $user->password)) {

            session(['id' => $request->get('id')]); //1 ingles , 2 vocacional
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            session(['user_rol' => $user->getRoleNames()->first()]);
            session(['user_email' => $user->email]);

            //dd($user->id, $user->name, $user->getRoleNames()->first(), $user->email);


            //$user = User::find(auth()->user()->id);
            if ( $user->getRoleNames()->first() == 'administrador') {
                return redirect('curso/examen/admin');
            }

            return Redirect::to('curso/examen');
        } else {
            // Password does not match
            dd('Invalid credentials');
        }
    }

    public function cerrar_sesion()
    {
        //dd("cerrar sesion");

        if (session('id') == '1') {
            session()->flush();
            return Redirect::to('login/1');
        } else {
            session()->flush();
            return Redirect::to('login/2');
        }
    }

    public function process_register(Request $request)
    {
        //dd("process register");

        $password = "12345678";

        //dd($request->name, $request->email);


        $user = User::where('email', $request->email)->first();


        //dd($user);
        if (!isset($user)) {
            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                //'password' => Hash::make($data['password']),
                'password' => Hash::make($password),
            ]);
        }




        session(['id' =>  $request->id]);
        session(['user_id' => $user->id]);
        session(['user_name' => $user->name]);
        session(['user_email' => $user->email]);

        $user = User::find(session('user_id'));
        if($user->hasRole('administrador'))
        {
            return redirect('curso/examen/admin');
        }

        return Redirect::to('curso/examen');

        /*$preguntas_seccion1 = Pregunta::whereBetween('id', [1, 20])->get();

        return view('examen.index', compact('preguntas_seccion1'));*/

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

        return view('home');


    }

}
