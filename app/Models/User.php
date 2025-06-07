<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Puedes dejar esta línea si quieres, está comentada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // ¡Esta línea es crucial!
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nombre_usuario',
        'rol',
        'biografia',
        'avatar',
        'fecha_registro',
        'activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'fecha_registro' => 'datetime',
        'activo' => 'boolean',
    ];

    /**
     * Get the resources for the user.
     */
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'autor_id'); // 'autor_id' es la FK en la tabla recursos
    }

    /**
     * Get the valoraciones for the user.
     */
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class, 'usuario_id'); // 'usuario_id' es la FK en la tabla valoraciones
    }

    /**
     * Get the descargas for the user.
     */
    public function descargas()
    {
        return $this->hasMany(Descarga::class, 'usuario_id'); // 'usuario_id' es la FK en la tabla descargas
    }

    /**
     * Get the blog posts for the user.
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'autor_id'); // 'autor_id' es la FK en la tabla blog_posts
    }

    /**
     * Get the blog comments for the user.
     */
    public function blogComentarios()
    {
        return $this->hasMany(BlogComentario::class, 'usuario_id'); // 'usuario_id' es la FK en la tabla blog_comentarios
    }
}