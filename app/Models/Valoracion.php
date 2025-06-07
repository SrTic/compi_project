<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    // AÑADE ESTA LÍNEA CLAVE
    protected $table = 'valoraciones'; 

    protected $fillable = [
        'puntuacion',
        'comentario',
        'fecha_valoracion',
        'recurso_id',
        'usuario_id',
    ];

    public $timestamps = false; // Esto está bien si no usas created_at/updated_at en esta tabla

    /**
     * Get the resource that the valoracion belongs to.
     */
    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }

    /**
     * Get the user that made the valoracion.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}