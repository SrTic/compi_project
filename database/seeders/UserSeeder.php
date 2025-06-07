<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Importa el modelo User
use Illuminate\Support\Facades\Hash; // Para hashear contraseñas

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un usuario administrador para pruebas
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Contraseña: password
            'email_verified_at' => now(),
            'nombre_usuario' => 'adminuser',
            'rol' => 'administrador',
            'biografia' => 'Usuario administrador del sistema.',
            'avatar' => 'https://via.placeholder.com/150/0000FF/FFFFFF?text=ADMIN',
            'fecha_registro' => now(),
            'activo' => true,
        ]);

        // Crea un usuario editor para pruebas
        User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'), // Contraseña: password
            'email_verified_at' => now(),
            'nombre_usuario' => 'editoruser',
            'rol' => 'editor',
            'biografia' => 'Usuario con privilegios de editor.',
            'avatar' => 'https://via.placeholder.com/150/00FF00/FFFFFF?text=EDITOR',
            'fecha_registro' => now(),
            'activo' => true,
        ]);

        // Crea 20 usuarios normales usando la factoría
        User::factory()->count(20)->create();
    }
}
