<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlogPost;     // Importa el modelo BlogPost
use App\Models\User;        // Importa el modelo User
use App\Models\BlogComentario; // Para comentarios anidados

class BlogComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => BlogPost::factory(),
            'usuario_id' => $this->faker->optional(0.8)->randomElement([User::factory(), null]), // 80% user, 20% null (invitado)
            'nombre_invitado' => $this->faker->optional(0.2)->name(), // Nombre si es invitado (20% de prob)
            'email_invitado' => $this->faker->optional(0.2)->safeEmail(), // Email si es invitado (20% de prob)
            'contenido' => $this->faker->paragraph(rand(1, 3)),
            'fecha_comentario' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'aprobado' => $this->faker->boolean(90), // 90% aprobado
            // comentario_padre_id se gestionará en el seeder para anidar, no en la factoría directamente
            'comentario_padre_id' => null, // Por defecto null, se asignará en el seeder si es un comentario hijo
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (BlogComentario $comentario) {
            // Lógica para anidar comentarios: 20% de probabilidad de tener un comentario padre
            if ($this->faker->boolean(20) && BlogComentario::count() > 1) {
                $comentario->comentario_padre_id = BlogComentario::inRandomOrder()->whereNull('comentario_padre_id')->first()->id ?? null;
                $comentario->save();
            }
        });
    }
}
