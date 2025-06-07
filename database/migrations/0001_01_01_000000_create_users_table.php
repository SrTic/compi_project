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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Columnas personalizadas que el modelo y los seeders esperan
            $table->string('nombre_usuario', 255)->unique()->nullable(); // Corregido de 'apellidos'
            $table->string('rol', 50)->default('usuario');
            $table->text('biografia')->nullable(); // Añadida la columna 'biografia'
            $table->string('avatar', 255)->nullable(); // Añadida la columna 'avatar'
            $table->timestamp('fecha_registro')->useCurrent(); // Esta ya estaba
            $table->boolean('activo')->default(true); // Esta ya estaba

            // Nota: Se ha eliminado 'ultimo_acceso' ya que no estaba en el seeder/factory
            // Si realmente lo necesitas, deberás añadirlo también en la factoría y el seeder.

            $table->rememberToken();
            $table->timestamps();
        });

        // Asegúrate de que las otras tablas de autenticación básicas también se creen
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};