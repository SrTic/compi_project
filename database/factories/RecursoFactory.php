<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Importa el modelo User
use App\Models\Area; // Importa el modelo Area
use App\Models\Nivel; // Importa el modelo Nivel

class RecursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(rand(3, 8)),
            'descripcion' => $this->faker->paragraphs(rand(2, 5), true),
            'url' => $this->faker->url(),
            'tipo_archivo' => $this->faker->fileExtension(),
            'tamaño_archivo' => $this->faker->numberBetween(100, 50000), // En KB
            'fecha_subida' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'activo' => $this->faker->boolean(),
            'numero_descargas' => $this->faker->numberBetween(0, 1000),
            'promedio_valoracion' => $this->faker->randomFloat(1, 1, 5), // Un decimal entre 1.0 y 5.0
            'autor_id' => User::factory(), // Crea un nuevo usuario y usa su ID
            'area_id' => Area::factory(),   // Crea una nueva área y usa su ID
            'nivel_id' => Nivel::factory(), // Crea un nuevo nivel y usa su ID
        ];
    }
}