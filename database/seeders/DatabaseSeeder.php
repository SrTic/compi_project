<?php

namespace Database\Seeders;

// No necesitas importar cada Seeder aquí, Laravel lo resuelve automáticamente con $this->call

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // El orden es CRUCIAL debido a las claves foráneas

        // 1. Seeders sin dependencias o con dependencias de User
        $this->call([
            UserSeeder::class, // Primero, ya que muchos dependen de usuarios
            AreaSeeder::class,
            NivelSeeder::class,
            EtiquetaSeeder::class,
            BlogCategoriaSeeder::class,
        ]);

        // 2. Seeders que dependen de los anteriores
        $this->call([
            RecursoSeeder::class,
            BlogPostSeeder::class,
        ]);

        // 3. Seeders que dependen de Recursos y BlogPosts
        $this->call([
            ValoracionSeeder::class,
            DescargaSeeder::class,
            ArtefactoSeeder::class,
            BlogComentarioSeeder::class,
        ]);

        // Las tablas pivote (RecursoEtiquetaSeeder y BlogPostEtiquetaSeeder)
        // se llenan a través de las relaciones belongsToMany con attach()
        // en RecursoSeeder y BlogPostSeeder, por lo que no es necesario llamarlas aquí directamente.
        // Si las llamaras, su run() está vacío, así que no causarían problemas,
        // pero es más limpio no llamarlas si su lógica está manejada por los seeders principales.
    }
}