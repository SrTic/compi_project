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
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->foreignId('recurso_id')->constrained('recursos')->onDelete('cascade'); // FK a recursos
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade'); // FK a users
            
            // Hemos cambiado 'valoracion' a 'puntuacion' para que coincida con el seeder
            $table->integer('puntuacion')->unsigned(); // Puntuación (1-5)
            $table->text('comentario')->nullable(); // Comentario, puede ser nulo
            
            // Hemos cambiado 'fecha' a 'fecha_valoracion' para que coincida con el seeder
            $table->timestamp('fecha_valoracion')->useCurrent(); // Fecha y hora de la valoración
            
            // Si necesitas 'created_at' y 'updated_at', activa timestamps().
            // Si solo usas 'fecha_valoracion' y $timestamps = false en el modelo, entonces no lo añadas.
            // Por el momento, asumimos que 'fecha_valoracion' es tu único campo de tiempo relevante.
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};