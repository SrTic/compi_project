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
        Schema::create('recursos', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('titulo', 255); // Título del recurso
            $table->text('descripcion'); // Descripción del recurso
            $table->string('url', 255)->nullable(); // URL externa, puede ser nula
            $table->string('tipo', 50); // Tipo de recurso (ej. 'video', 'documento', 'enlace')
            $table->string('archivo_url', 255)->nullable(); // URL del archivo subido, puede ser nula
            $table->string('miniatura_url', 255)->nullable(); // URL de la miniatura, puede ser nula
    
            // Claves Foráneas
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade'); // ID del usuario que sube el recurso (FK a users)
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade'); // ID del área a la que pertenece (FK a areas)
            $table->foreignId('nivel_id')->constrained('niveles')->onDelete('cascade'); // ID del nivel al que pertenece (FK a niveles)
    
            $table->timestamp('fecha_creacion')->useCurrent(); // Fecha y hora de creación
            $table->timestamp('fecha_modificacion')->nullable(); // Última fecha de modificación, puede ser nula
            $table->decimal('valoracion_media', 3, 2)->default(0.00); // Valoración media con 2 decimales
            $table->integer('numero_descargas')->default(0); // Número de descargas
            $table->integer('numero_vistas')->default(0); // Número de vistas
            $table->boolean('destacado')->default(false); // Si es un recurso destacado
            $table->boolean('activo')->default(true); // Si el recurso está activo
            // Nota: No se usa timestamps() aquí ya que tenemos fecha_creacion y fecha_modificacion custom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};
