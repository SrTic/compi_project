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
        Schema::create('blog_comentarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->foreignId('post_id')->constrained('blog_posts')->onDelete('cascade'); // FK a blog_posts
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('set null'); // FK a users, puede ser nulo si el usuario se borra
            $table->string('nombre_invitado', 255)->nullable(); // Nombre para comentarios de invitados
            $table->string('email_invitado', 255)->nullable(); // Email para comentarios de invitados
            $table->text('contenido'); // Contenido del comentario
            $table->timestamp('fecha_comentario')->useCurrent(); // Fecha y hora del comentario
            $table->boolean('aprobado')->default(false); // Si el comentario ha sido aprobado
            $table->foreignId('comentario_padre_id')->nullable()->constrained('blog_comentarios')->onDelete('cascade'); // Para comentarios anidados
            // No se usa timestamps() aquí ya que tenemos fecha custom
        }); // <--- ¡Asegúrate de que este punto y coma esté ahí!
    } // Esta llave cierra la función 'up()'

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comentarios');
    }
};
