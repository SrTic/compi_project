<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategoria extends Model
{
    use HasFactory;

    protected $table = 'blog_categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
    ];

    /**
     * Get the blog posts for the category.
     */
    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class, 'categoria_id'); // 'categoria_id' es la FK en blog_posts
    }
}