<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'titulo',
        'slug',
        'contenido',
        'resumen',
        'imagen_destacada',
        'autor_id',
        'categoria_id',
        'fecha_publicacion',
        'ultima_actualizacion',
        'activo',
        'numero_vistas',
    ];

    // public $timestamps = false; // Descomenta si no usas created_at y updated_at automáticos

    /**
     * Get the user that authored the blog post.
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    /**
     * Get the category that the blog post belongs to.
     */
    public function categoria()
    {
        return $this->belongsTo(BlogCategoria::class, 'categoria_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function blogComentarios()
    {
        return $this->hasMany(BlogComentario::class, 'post_id');
    }

    /**
     * The tags that belong to the blog post.
     */
    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'blog_post_etiquetas', 'post_id', 'etiqueta_id');
    }
}