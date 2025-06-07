<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComentario extends Model
{
    use HasFactory;

    protected $table = 'blog_comentarios';

    protected $fillable = [
        'post_id',
        'usuario_id',
        'nombre_invitado',
        'email_invitado',
        'contenido',
        'fecha_comentario',
        'aprobado',
        'comentario_padre_id',
    ];

    public $timestamps = false; // BlogComentario tiene fecha_comentario personalizada

    /**
     * Get the blog post that the comment belongs to.
     */
    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class, 'post_id');
    }

    /**
     * Get the user that authored the comment (if logged in).
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Get the parent comment that this comment belongs to.
     */
    public function padre()
    {
        return $this->belongsTo(BlogComentario::class, 'comentario_padre_id');
    }

    /**
     * Get the child comments for the current comment.
     */
    public function hijos()
    {
        return $this->hasMany(BlogComentario::class, 'comentario_padre_id');
    }
}