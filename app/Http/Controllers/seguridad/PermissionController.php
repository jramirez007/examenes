<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
        if (auth()->user()->can('seguridad')== true) {
        $permisos = Permissions::get();
        // dd($permision);
        return view('seguridad.permission.index', compact('permisos'));
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
        $messages = [
            'name.required' => 'ingresar nombre',


        ];

        $request->validate([
            'name' => 'required',

        ], $messages);

        $permission = Permission::create(['name' =>  $request->name]);
        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $messages = [
            'name.required' => 'ingresar nombre',
        ];

        $request->validate([
            'name' => 'required',

        ], $messages);

        $permission = Permissions::findOrFail($id);
        $permission->name = $request->get('name');
        $permission->update();
        alert()->success('El registro ha sido modificado correctamente');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permissions::findOrFail($id);
        $permission->delete();
        alert()->error('El registro ha sido eliminado correctamente');
        return back();
    }
}
