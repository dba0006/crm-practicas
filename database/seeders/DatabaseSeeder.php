<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Eliminar todos los usuarios existentes
        User::truncate();
        
        // Crear solo el usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@crm.com',
            'password' => bcrypt('1234'),
            'role' => 'admin',
        ]);
    }
}
