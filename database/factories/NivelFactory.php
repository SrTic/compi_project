<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Nivel; // Importa el modelo Nivel

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nivel>
 */
class NivelFactory extends Factory
{
    // Asegúrate de que el modelo esté asociado correctamente
    protected $model = Nivel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Opción más robusta para el nombre, usa 'sentence()' o 'name()'
            // Esto es menos propenso a agotar las opciones que 'word()'
            'nombre' => $this->faker->unique()->sentence(2, true) . ' Nivel', // Genera una frase de 2 palabras
            // O podrías usar algo como:
            // 'nombre' => 'Nivel ' . $this->faker->unique()->randomNumber(4), // Si un número es aceptable
            // 'nombre' => $this->faker->unique()->colorName() . ' Nivel', // Más variedad de palabras

            'descripcion' => $this->faker->sentence(), // Genera una descripción aleatoria
        ];
    }
}
