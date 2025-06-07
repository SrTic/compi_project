<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nivel; // Importa el modelo

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Puedes crear niveles específicos si los nombres importan, o usar la factoría
        Nivel::create(['nombre' => 'Primaria', 'descripcion' => 'Recursos para educación primaria.']);
        Nivel::create(['nombre' => 'Secundaria', 'descripcion' => 'Recursos para educación secundaria.']);
        Nivel::create(['nombre' => 'Bachillerato', 'descripcion' => 'Recursos para bachillerato.']);
        Nivel::create(['nombre' => 'Universidad', 'descripcion' => 'Recursos para educación universitaria.']);
        Nivel::create(['nombre' => 'Formación Profesional', 'descripcion' => 'Recursos para formación profesional.']);

        // O puedes usar la factoría para generar más si necesitas
        // Nivel::factory()->count(2)->create();
    }
}