<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etiqueta; // Importa el modelo
use Illuminate\Support\Str; // Importa Str para slugs

class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Puedes crear algunas etiquetas específicas
        $etiquetas = ['Matemáticas', 'Ciencias', 'Historia', 'Literatura', 'Programación', 'Diseño', 'Arte', 'Música', 'Idiomas', 'Deportes'];
        foreach ($etiquetas as $nombre) {
            Etiqueta::create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
            ]);
        }

        // Crea algunas etiquetas adicionales con la factoría
        Etiqueta::factory()->count(15)->create();
    }
}