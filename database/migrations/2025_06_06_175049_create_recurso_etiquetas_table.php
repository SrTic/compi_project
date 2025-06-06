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
        Schema::create('recurso_etiquetas', function (Blueprint $table) {
     // Claves Foráneas Compuestas
     $table->foreignId('recurso_id')->constrained('recursos')->onDelete('cascade'); // FK a recursos
     $table->foreignId('etiqueta_id')->constrained('etiquetas')->onDelete('cascade'); // FK a etiquetas
     $table->primary(['recurso_id', 'etiqueta_id']); // Clave primaria compuesta
     // No se usa timestamps() en tablas pivote por lo general
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurso_etiquetas');
    }
};
