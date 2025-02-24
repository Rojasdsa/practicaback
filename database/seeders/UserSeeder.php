<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'surname' => 'god',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'user',
            'surname' => 'noob',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('user'),
            'remember_token' => Str::random(10),
            'created_at' => now()
        ]);
    }
}
