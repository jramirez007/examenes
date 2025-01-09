<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use App\Models\catalogo\Departamento;
use App\Models\catalogo\Empresa;
use App\Models\catalogo\Puesto;
use App\Models\Role;
use App\Models\Sesion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        //    dd($user->hasRole('encargado'));
        if (auth()->user()->can('seguridad') == true) {
            //
            $usuarios = User::get();
            foreach ($usuarios as $usuario) {
                $usuario->roles = $usuario->roles->pluck('name')->implode(', ');
            }
            return view('seguridad.usuarios.index', compact('usuarios'));
        } else {
            alert()->error('Usuario No Autorizado');
            return redirect()->route('home');
        }
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/|unique:users',
            'password' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',

        ], [
            'name.required' => 'El nombre es un valor requerido',
            'name.unique' => 'El nombre de usuario ingresado ya existe',
            'password.required' => 'La clave es un valor requerido',
            'email.required' => 'El correo electrónico es un valor requerido',
            'email.unique' => 'El correo ingresado ya existe',

        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encriptar la contraseña
            'activo' => 1
        ]);

        alert()->success('se han sido Agregado Usuario correctamente');

        return redirect('seguridad/usuario/' . $user->id . '/edit');
    }

    public function show($id)
    {
        //
    }

    public function lista_usuarios()
    {

        $usuarios = User::whereDoesntHave('roles', function ($query) {
            $query->where('id', 1);
        })->get();
        // $usuarios = User::get();

        foreach ($usuarios as $usuario) {
            $usuario->roles = $usuario->roles->pluck('name')->implode(', ');
        }
        return view('seguridad.usuarios.listado', compact('usuarios'));
    }

    public function update_roles(Request $request)
    {

        $rol = Role::findOrFail($request->rol_id);
        $usuario = User::findOrFail($request->usuario_id);

        if ($usuario->user_has_role->where('id', $request->rol_id)->count() > 0) {
            $usuario->removeRole($rol->name);
        } else {
            $usuario->assignRole($rol->name);
        }

        return $usuario;
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);

        $roles = Role::get();
        return view('seguridad.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ], [
            'name.required' => 'El nombre es un valor requerido',
            'name.unique' => 'El nombre de usuario ingresado ya existe',
            'email.required' => 'El correo electrónico es un valor requerido',
            'email.unique' => 'El correo ingresado ya existe',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (auth()->user()->hasRole('super administrador')) {
            $user->empresa_id = $request->empresa_id;
            $user->puesto_id = $request->puesto_id;
        }
        $user->departamento_id = $request->departamento_id;
        $user->save();

        alert()->success('Registro modificado correctamente');
        return back();
    }


    public function reset_clave(Request $request, $id)
    {
        $request->merge([
            'password' => trim($request->input('password')),
        ]);

        $validatedData = $request->validate([
            'password' => 'required|string|min:8|max:255',
        ], [
            'password.required' => 'La clave es un valor requerido',
            'password.min' => 'La clave debe tener al menos 8 caracteres',
        ]);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->update();

        alert()->success('Registro modificado correctamente');
        return back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        alert()->success('Registro eliminado correctamente');
        return back();
    }

    public function update_estado($id)
    {
        $user = User::findOrFail($id);
        $user->activo = $user->activo == 1 ? 0 : 1;
        $user->update();

        return response()->json(['success' => true]);


        alert()->success('Registro desactivado correctamente');
        return back();
    }
}
