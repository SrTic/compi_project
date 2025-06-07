<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;

    // ¡Añade esta línea!
    protected $table = 'niveles'; // Indica que la tabla asociada a este modelo es 'niveles'

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Get the resources for the level.
     */
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'nivel_id'); // 'nivel_id' es la FK en la tabla recursos
    }
}