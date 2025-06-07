<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Opción 1: Usar una frase corta única (generalmente más variada)
            'nombre' => $this->faker->unique()->sentence(rand(2, 4), true) . ' Area', // Genera una frase corta y añade " Area"

            // Opción 2: Usar algo como un nombre de compañía (a menudo más único)
            // 'nombre' => $this->faker->unique()->company() . ' Area',

            // Opción 3: Combinar con un número aleatorio para asegurar unicidad
            // 'nombre' => $this->faker->unique()->word() . ' ' . $this->faker->randomNumber(3), // Asegura unicidad con un número
            
            'descripcion' => $this->faker->sentence(10),
        ];
    }
}