<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Importa la clase Str
use App\Models\User;         // Importa el modelo User
use App\Models\BlogCategoria; // Importa el modelo BlogCategoria

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->sentence(rand(5, 10));
        return [
            'titulo' => $titulo,
            'slug' => Str::slug($titulo) . '-' . $this->faker->unique()->randomNumber(5), // Asegura unicidad
            'contenido' => $this->faker->paragraphs(rand(5, 15), true),
            'resumen' => $this->faker->paragraph(2),
            'imagen_destacada' => $this->faker->optional(0.8)->imageUrl(1280, 720, 'blog', true), // 80% de probabilidad de tener imagen
            'autor_id' => User::factory(),
            'categoria_id' => BlogCategoria::factory(),
            
            // ¡AJUSTE AQUÍ! Usar 'created_at' y 'updated_at' en lugar de custom timestamps
            // Laravel manejará esto automáticamente si el modelo no tiene $timestamps = false;
            // Sin embargo, si necesitas sembrar fechas específicas, puedes hacer esto:
            'created_at' => $this->faker->dateTimeBetween('-2 years', '-1 year'), // Fecha de creación más antigua
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),    // Fecha de actualización más reciente
            
            'activo' => $this->faker->boolean(90), // 90% de probabilidad de ser activo
            'numero_vistas' => $this->faker->numberBetween(0, 5000),
        ];
    }
}