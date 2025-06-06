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
        $table->integer('valoracion')->unsigned(); // Valoración (1-5)
        $table->text('comentario')->nullable(); // Comentario, puede ser nulo
        $table->timestamp('fecha')->useCurrent(); // Fecha y hora de la valoración
        // No se usa timestamps() aquí ya que tenemos fecha custom
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
