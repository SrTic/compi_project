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
        Schema::create('artefactos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('titulo', 255); // Título del artefacto
            $table->text('descripcion'); // Descripción del artefacto
            $table->string('tipo', 50); // Tipo de artefacto (ej. 'imagen', 'video', 'documento 3D')
            $table->string('archivo_url', 255)->nullable(); // URL del archivo subido, puede ser nula
            $table->string('miniatura_url', 255)->nullable(); // URL de la miniatura, puede ser nula
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade'); // ID del usuario que sube el artefacto (FK a users)
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha y hora de creación
            $table->decimal('valoracion_media', 3, 2)->default(0.00); // Valoración media con 2 decimales
            $table->integer('numero_descargas')->default(0); // Número de descargas
            $table->boolean('activo')->default(true); // Si el artefacto está activo
            // No se usa timestamps() aquí ya que tenemos fecha custom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artefactos');
    }
};
