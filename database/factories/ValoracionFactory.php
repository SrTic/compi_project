<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recurso; // Importa el modelo Recurso
use App\Models\User;    // Importa el modelo User
// Asegúrate de que no hay un 'use App\Models\Valoracion;' aquí
// Si el modelo Valoracion existiera en app/Models/Valoracion.php,
// no necesitas usarlo aquí a menos que el nombre de la clase sea ambiguo.

class ValoracionFactory extends Factory
{
    // Define el modelo asociado a esta factoría
    protected $model = \App\Models\Valoracion::class; // Asegúrate de que esto apunte a tu modelo Valoracion real

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'puntuacion' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->optional(0.7)->paragraph(1), // Opcional el 70% de las veces
            'fecha_valoracion' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'recurso_id' => Recurso::factory(), // Crea un nuevo recurso si no existe uno
            'usuario_id' => User::factory(),    // Crea un nuevo usuario si no existe uno
        ];
    }
}