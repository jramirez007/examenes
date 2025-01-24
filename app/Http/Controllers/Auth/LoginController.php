<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        //dd($request->get('id'), $request->get('email'), $request->get('password'));

        $email = $request->get('email');
        $passwordInput = $request->get('password');

        // Retrieve the user by email
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($passwordInput, $user->password)) {

            session(['id' => $request->get('id')]); //1 ingles , 2 vocacional
            session(['user_id' => $user->id]);
            session(['user_name' => $user->name]);
            session(['user_rol' => $user->getRoleNames()->first()]);
            session(['user_email' => $user->email]);




            //$user = User::find(auth()->user()->id);
            if ($user->hasRole('administrador')) {
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


        if (session('id') == '1') {
            session()->flush();
            return Redirect::to('login/1');
        } else {
            session()->flush();
            return Redirect::to('login/2');
        }
    }
}
