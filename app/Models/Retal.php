<?php

namespace App\Models;

use Database\Factories\RetalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retal extends Model
{
    use HasFactory;

    protected $table = 'retales';

    protected $fillable = [
        'tejido',
        'subcategoria',
        'gama',
        'color_primario',
        'color_secundario',
        'metros',
        'precio_base',
        'precio_retal',
        'estado',
        'descripcion'
    ];

    public function imagenes()
    {
        return $this->hasMany(RetalImagen::class, 'retal_id');
    }

    /* REVISAR */
    public static function newFactory():RetalFactory
    {
        return new RetalFactory();
    }

    const ESTADO_DISPONIBLE = "disponible";
    const ESTADO_VENDIDO    = "vendido";

    const ESTADOS = [
        self::ESTADO_DISPONIBLE,
        self::ESTADO_VENDIDO
    ];
    /* TODO AÑADIR EL RESTO DE CONSTANTES DE LOS ENUM DE LA MIGRATION */

}