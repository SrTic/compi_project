<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;     // Importa el modelo BlogPost
use App\Models\Etiqueta;     // Importa el modelo Etiqueta

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etiquetas = Etiqueta::all();

        BlogPost::factory()->count(25)->create()->each(function ($post) use ($etiquetas) {
            // Adjunta de 1 a 4 etiquetas aleatorias a cada blog post
            $post->etiquetas()->attach(
                $etiquetas->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}