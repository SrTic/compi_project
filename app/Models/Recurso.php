<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'url',
        'tipo_archivo',
        'tamaño_archivo',
        'fecha_subida',
        'activo',
        'numero_descargas',
        'promedio_valoracion',
        'autor_id',
        'area_id',
        'nivel_id',
    ];

    /**
     * Get the user that owns the resource.
     */
    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    /**
     * Get the area that the resource belongs to.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Get the level that the resource belongs to.
     */
    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    /**
     * Get the valoraciones for the resource.
     */
    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }

    /**
     * Get the downloads for the resource.
     */
    public function descargas()
    {
        return $this->hasMany(Descarga::class);
    }

    /**
     * Get the artifacts for the resource.
     */
    public function artefactos()
    {
        return $this->hasMany(Artefacto::class);
    }

    /**
     * The tags that belong to the resource.
     */
    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'recurso_etiquetas', 'recurso_id', 'etiqueta_id');
    }
}