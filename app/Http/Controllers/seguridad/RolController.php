<?php

namespace App\Http\Controllers\seguridad;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RolController extends Controller
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
        $roles = Role::get();
        return view('seguridad.rol.index', compact('roles'));
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
        //}
        $messages = [
            'name.required' => 'ingresar nombre',


        ];

        $request->validate([
            'name' => 'required',

        ], $messages);

        $role = ModelsRole::create(['name' => $request->name]);
        //$rol =  Role::create(['name' => $request->name,'guard_name' => 'web']);

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
        $rol = Role::findorfail($id);

        //$rol_has_permision = $rol->role_has_permissions;

        $permisos = Permissions::get();

        return view('seguridad.rol.edit', compact('rol', 'permisos'));
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
        $messages = [
            'name.required' => 'ingresar nombre',


        ];

        $request->validate([
            'name' => 'required',

        ], $messages);

        $rol = Role::findOrFail($id);

        $rol->name = $request->get('name');

        $rol->update();
        alert()->success('El registro ha sido modificado correctamente');
        return back();
    }



    public function  update_permission(request $request)
    {

        try {
            $permision = Permissions::findOrfail($request->permiso_id);


            $role = Role::findOrFail($request->role_id);

            $count_unidad =  $permision->permissions_has_role->where('id', $role->id)->count();
      //  return $count_unidad;
            if ($count_unidad == 0) {

                $role = ModelsRole::findOrFail($request->role_id);

                $permission = Permission::findOrFail($request->permiso_id);

                $role->givePermissionTo($permission->name);
            } else {
                $role = ModelsRole::findOrFail($request->role_id);

                $permission = Permission::findOrFail($request->permiso_id);

                $role->revokePermissionTo($permission->name);
            }


            $result = [$role];
            return $result;

            // return 1;
        } catch (Exception $e) {
            return 0;
        }
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
        $rol = Role::findOrFail($id);
        $rol->delete();
        alert()->error('El registro ha sido eliminado correctamente');
        return back();
    }



}
