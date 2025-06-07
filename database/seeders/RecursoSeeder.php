<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recurso;   // Importa el modelo Recurso
use App\Models\User;     // Importa el modelo User
use App\Models\Area;     // Importa el modelo Area
use App\Models\Nivel;    // Importa el modelo Nivel
use App\Models\Etiqueta; // Importa el modelo Etiqueta

class RecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que existan usuarios, áreas, niveles y etiquetas antes de crear recursos
        // Si usas factorías en RecursoFactory que crean sus propias dependencias,
        // esto no es estrictamente necesario aquí, pero es una buena práctica.
        $users = User::all();
        $areas = Area::all();
        $niveles = Nivel::all();
        $etiquetas = Etiqueta::all();

        // Crea 50 recursos
        Recurso::factory()->count(50)->create()->each(function ($recurso) use ($etiquetas) {
            // Adjunta de 1 a 5 etiquetas aleatorias a cada recurso
            $recurso->etiquetas()->attach(
                $etiquetas->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
