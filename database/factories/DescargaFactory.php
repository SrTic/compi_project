<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recurso; // Importa el modelo Recurso
use App\Models\User;    // Importa el modelo User

class DescargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_descarga' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'recurso_id' => Recurso::factory(), // Crea un nuevo recurso
            'usuario_id' => User::factory(),    // Crea un nuevo usuario
            'ip_address' => $this->faker->ipv4(), // Añade esta línea para generar una IP aleatoria
        ];
    }
}
