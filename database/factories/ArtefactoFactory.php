<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User; // Importa el modelo User si el artefacto tiene un autor

class ArtefactoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Estas columnas coinciden con tu migración create_artefactos_table
            'titulo' => $this->faker->sentence(3),
            'descripcion' => $this->faker->paragraph(),
            'tipo' => $this->faker->randomElement(['imagen', 'video', 'documento_3d', 'audio']), // Ejemplos de tipos
            'archivo_url' => $this->faker->url(), // 'url' de tu factory anterior, ahora 'archivo_url'
            'miniatura_url' => $this->faker->optional(0.5)->imageUrl(640, 480, 'abstract', true), // Opcional
            'autor_id' => User::factory(), // Asocia un autor
            'fecha_creacion' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'valoracion_media' => $this->faker->randomFloat(2, 0, 5), // Valoración media aleatoria
            'numero_descargas' => $this->faker->numberBetween(0, 1000),
            'activo' => $this->faker->boolean(90), // 90% de ser activo
            // 'timestamps' se añaden automáticamente si no usas custom dates,
            // pero tu migración tiene 'fecha_creacion' por lo que Laravel no usará created_at/updated_at por defecto.
        ];
    }
}