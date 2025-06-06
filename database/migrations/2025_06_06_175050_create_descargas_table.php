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
        Schema::create('descargas', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->foreignId('recurso_id')->constrained('recursos')->onDelete('cascade'); // FK a recursos
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null'); // FK a users, puede ser nulo si el usuario se borra
            $table->string('ip_address', 45); // Dirección IP de quien descarga
            $table->timestamp('fecha_descarga')->useCurrent(); // Fecha y hora de la descarga
            // No se usa timestamps() aquí ya que tenemos fecha custom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('descargas');
    }
};
