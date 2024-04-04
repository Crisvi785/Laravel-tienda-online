<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //Crear un usuario ficticio para usuarios no registrados
        User::create([
            'id' => 1,
            'name' => 'Guest',
            'lastname' => '',
            'email' => 'guest@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Crear un usuario con role 1
        User::create([
            'role' => 1,
            'name' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Crear otros usuarios con role 0
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'role' => 0,
                'name' => 'User' . $i,
                'lastname' => 'Lastname' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
        }

    }
}