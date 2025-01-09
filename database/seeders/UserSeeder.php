<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create( ['name' => 'create roles'] );
        Permission::create( ['name' => 'read roles'] );
        Permission::create( ['name' => 'edit roles'] );
        Permission::create( ['name' => 'delete roles'] );

        Permission::create( ['name' => 'create users'] );
        Permission::create( ['name' => 'read users'] );
        Permission::create( ['name' => 'edit users'] );
        Permission::create( ['name' => 'delete users'] );

        Permission::create( ['name' => 'create permissions'] );
        Permission::create( ['name' => 'read permissions'] );
        Permission::create( ['name' => 'edit permissions'] );
        Permission::create( ['name' => 'delete permissions'] );

        Permission::create( ['name' => 'catalogos'] );
        Permission::create( ['name' => 'seguridad'] );

        $role = Role::create( ['name' => 'administrador'] );
        $role->givePermissionTo( Permission::all() );


        $user = User::create( [
            'name'=>'Administrador',
            'email'=>'admin@mail.com',
            'password'=> bcrypt( '12345678' ),
        ] );

        $user->assignRole('administrador');
    }
}
