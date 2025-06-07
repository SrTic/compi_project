<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // Contraseña por defecto: 'password'
            'remember_token' => Str::random(10),
            // Columnas añadidas por ti:
            'nombre_usuario' => $this->faker->unique()->userName(),
            'rol' => $this->faker->randomElement(['usuario', 'editor', 'administrador']), // O los roles que uses
            'biografia' => $this->faker->paragraph(2),
            'avatar' => $this->faker->imageUrl(640, 480, 'people', true), // URL de imagen de avatar
            'fecha_registro' => $this->faker->dateTimeBetween('-2 years', 'now')->setTime($this->faker->numberBetween(3, 23), $this->faker->numberBetween(0, 59), $this->faker->numberBetween(0, 59))->format('Y-m-d H:i:s'),
            'activo' => $this->faker->boolean(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
