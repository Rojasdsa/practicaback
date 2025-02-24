<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'surname' => 'god',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'created_at' => now()
        ],
        [
            'name' => 'user',
            'surname' => 'noob',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'created_at' => now()
        ]);
    }
}
