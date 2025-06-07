<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogComentario; // Importa el modelo

class BlogComentarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea comentarios de nivel superior
        BlogComentario::factory()->count(50)->create([
            'comentario_padre_id' => null, // Asegura que sean comentarios raíz inicialmente
        ]);

        // Para crear comentarios anidados, puedes hacer un bucle y asignarles padres existentes
        // Esta lógica ya está en la factoría en el método 'configure',
        // así que con los 50 de arriba ya se generarán algunos anidados.
        // Si quieres más anidados, puedes hacer:
        // BlogComentario::factory()->count(20)->create();
    }
}
