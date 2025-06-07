<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Get the resources for the area.
     */
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'area_id'); // 'area_id' es la FK en la tabla recursos
    }
}
