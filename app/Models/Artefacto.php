<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artefacto extends Model
{
    use HasFactory;

    // ¡Añade esta línea!
    public $timestamps = false; // Indica a Eloquent que no use created_at y updated_at

    // ... el resto de tu código de fillable, relaciones, etc.
}