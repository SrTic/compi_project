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
        Schema::create('blog_post_etiquetas', function (Blueprint $table) {
           // Claves Foráneas Compuestas
        $table->foreignId('post_id')->constrained('blog_posts')->onDelete('cascade'); // FK a blog_posts
        $table->foreignId('etiqueta_id')->constrained('etiquetas')->onDelete('cascade'); // FK a etiquetas
        $table->primary(['post_id', 'etiqueta_id']); // Clave primaria compuesta
        // No se usa timestamps() en tablas pivote
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_etiquetas');
    }
};
