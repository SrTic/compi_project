<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('titulo', 255); // Título del post
            $table->string('slug', 255)->unique(); // Slug (URL amigable), único
            $table->longText('contenido'); // Contenido completo del post
            $table->text('resumen'); // Resumen del post
            $table->string('imagen_destacada', 255)->nullable(); // URL de la imagen destacada, puede ser nula

            // Claves Foráneas
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade'); // ID del usuario autor (FK a users)
            $table->foreignId('categoria_id')->constrained('blog_categorias')->onDelete('cascade'); // ID de la categoría (FK a blog_categorias)

            // Eliminamos estas líneas y usamos timestamps()
            // $table->timestamp('fecha_publicacion')->useCurrent(); // Fecha y hora de publicación
            // $table->timestamp('ultima_actualizacion')->nullable(); // Última fecha de actualización, puede ser nula

            $table->boolean('activo')->default(true); // Si el post está activo
            $table->integer('numero_vistas')->default(0); // Número de vistas

            // ¡Añade esta línea! Esto creará 'created_at' y 'updated_at'
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};