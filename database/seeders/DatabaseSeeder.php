<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* Aquí se crea el usuario, el rol y los permisos */
        $this->call([
            UserSeeder::class,
        ]);
    }
}
