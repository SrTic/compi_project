<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Importa la clase Str para el slug

class EtiquetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->unique()->word();
        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre), // Genera un slug a partir del nombre
        ];
    }
}