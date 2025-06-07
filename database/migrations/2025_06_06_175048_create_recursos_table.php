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
            
            // Columnas ajustadas para coincidir con el seeder/factory
            $table->string('tipo_archivo', 50)->nullable(); // Tipo de archivo (ej. 'pdf', 'mp4') - Anteriormente 'tipo'
            $table->integer('tamaño_archivo')->nullable(); // Tamaño del archivo en KB o bytes
            
            // Claves Foráneas
            $table->foreignId('autor_id')->constrained('users')->onDelete('cascade'); // ID del usuario que sube el recurso (FK a users)
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade'); // ID del área a la que pertenece (FK a areas)
            $table->foreignId('nivel_id')->constrained('niveles')->onDelete('cascade'); // ID del nivel al que pertenece (FK a niveles)
            
            // Columnas ajustadas para coincidir con el seeder/factory
            $table->timestamp('fecha_subida')->useCurrent(); // Fecha y hora de subida del recurso - Anteriormente 'fecha_creacion'
            $table->integer('numero_descargas')->default(0); // Número de descargas
            $table->decimal('promedio_valoracion', 3, 2)->default(0.00); // Promedio de valoración con 2 decimales - Anteriormente 'valoracion_media'
            $table->boolean('activo')->default(true); // Si el recurso está activo
            
            // Columnas que no estaban en el seeder/factory pero si en tu migración original, las mantenemos o ajustamos si es necesario
            $table->string('miniatura_url', 255)->nullable(); // URL de la miniatura, puede ser nula (si no se usa en seeder, puede ignorarse)
            // $table->integer('numero_vistas')->default(0); // Si el seeder no la usa, se puede dejar que use el default
            // $table->boolean('destacado')->default(false); // Si el seeder no la usa, se puede dejar que use el default

            // Laravel timestamps para created_at y updated_at, para que el seeder pueda insertar los campos correctamente.
            // Si quieres controlar 'fecha_creacion' y 'fecha_modificacion' manualmente, no uses esto.
            // Pero el seeder espera 'updated_at' y 'created_at'.
            $table->timestamps(); 
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