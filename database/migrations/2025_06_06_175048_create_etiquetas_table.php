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
        Schema::create('etiquetas', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre', 255)->unique(); // Nombre de la etiqueta, único
            $table->string('slug', 255)->unique(); // ¡Añade esta línea para la columna 'slug'!
            $table->text('descripcion')->nullable(); // Descripción, puede ser nula
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etiquetas');
    }
};
