<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
    ];

    /**
     * The resources that belong to the tag.
     */
    public function recursos()
    {
        return $this->belongsToMany(Recurso::class, 'recurso_etiquetas', 'etiqueta_id', 'recurso_id');
    }

    /**
     * The blog posts that belong to the tag.
     */
    public function blogPosts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_etiquetas', 'etiqueta_id', 'post_id');
    }
}