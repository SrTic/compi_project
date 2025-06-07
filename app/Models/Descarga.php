<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_descarga',
        'recurso_id',
        'usuario_id',
    ];

    public $timestamps = false; // Descargas tienen fecha_descarga personalizada

    /**
     * Get the resource that the download belongs to.
     */
    public function recurso()
    {
        return $this->belongsTo(Recurso::class);
    }

    /**
     * Get the user that made the download.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // Asumo que el FK es 'usuario_id' en la tabla descargas
    }
}