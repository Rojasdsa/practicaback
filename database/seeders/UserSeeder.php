<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'panel admin']);

        Permission::create(['name' => 'ver usuarios']);
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);

        Permission::create(['name' => 'ver productos']);
        Permission::create(['name' => 'crear productos']);
        Permission::create(['name' => 'editar productos']);
        Permission::create(['name' => 'eliminar productos']);

        /* CREACIÓN DE USUARIO (admin) */
        $adminUser = User::query()->create([
            'name' => 'admin',
            'surname' => 'god',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
        /* CREACIÓN DE ROL */
        $roleAdmin = Role::create(['name' => 'super-admin']);
        /* ASIGNACIÓN DEL ROL AL USUARIO*/
        $adminUser->assignRole($roleAdmin);
        /* RECOGEMOS TODOS LOS PERMISOS */
        $permissionsAdmin = Permission::query()->pluck('name');
        /* ASIGNAMOS LOS PERMISOS AL ROL */
        $roleAdmin->syncPermissions($permissionsAdmin);

        /* CREACIÓN DE USUARIO (cliente) */
        $clientUser = User::query()->create([
            'name' => 'client',
            'surname' => 'noob',
            'email' => 'client@client.com',
            'email_verified_at' => now(),
            'password' => Hash::make('client'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
        /* CREACIÓN DE ROL */
        $roleClient = Role::create(['name' => 'client']);
        /* ASIGNACIÓN DEL ROL AL USUARIO*/
        $clientUser->assignRole($roleClient);
        /* ASIGNAMOS LOS PERMISOS AL ROL */
        $roleClient->syncPermissions('ver productos');


        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'surname' => 'god',
        //     'email' => 'admin@admin.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('admin'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => now()
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'user',
        //     'surname' => 'noob',
        //     'email' => 'user@user.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('user'),
        //     'remember_token' => Str::random(10),
        //     'created_at' => now()
        // ]);
    }
}
