<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetalImagen extends Model
{
    use HasFactory;

    protected $table = 'retal_imagenes';

    protected $fillable = [
        'retal_id',
        'ruta_imagen'
    ];

    /* Relación inversa con Retal */
    public function retal()
    {
        return $this->belongsTo(Retal::class, 'retal_id');
    }
}
