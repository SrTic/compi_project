<?php

namespace Database\Seeders; // <- ¡Este es el namespace correcto para un Seeder!

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artefacto; // Importa tu modelo Artefacto

class ArtefactoSeeder extends Seeder // <- ¡Esta es la clase Seeder!
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artefacto::factory()->count(80)->create(); // Lógica de tu seeder
    }
}
