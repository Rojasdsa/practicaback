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

    public static function newFactory(): RetalFactory
    {
        return new RetalFactory();
    }

    // Enum 'tejido'
    const TEJIDO_STRECH   = "strech";
    const TEJIDO_POPELIN   = "popelin";
    const TEJIDO_JACQUARD = "jacquard";
    const TEJIDO_VISCOSA  = "viscosa";

    const TEJIDOS = [
        self::TEJIDO_STRECH,
        self::TEJIDO_POPELIN,
        self::TEJIDO_JACQUARD,
        self::TEJIDO_VISCOSA
    ];

    // Enum 'subcategoria'
    const SUBCATEGORIA_ESTAMPADO = "estampado";
    const SUBCATEGORIA_FLOCADO   = "flocado";
    const SUBCATEGORIA_OTROS     = "otros";

    const SUBCATEGORIAS = [
        self::SUBCATEGORIA_ESTAMPADO,
        self::SUBCATEGORIA_FLOCADO,
        self::SUBCATEGORIA_OTROS
    ];
    // Enum 'gama'
    const GAMA_AMARILLO = "amarillo";
    const GAMA_AZUL     = "azul";
    const GAMA_BLANCO   = "blanco";
    const GAMA_GRIS     = "gris";
    const GAMA_MARRON   = "marrón";
    const GAMA_MORADO   = "morado";
    const GAMA_NARANJA  = "naranja";
    const GAMA_NEGRO    = "negro";
    const GAMA_ROJO     = "rojo";
    const GAMA_ROSA     = "rosa";
    const GAMA_VERDE    = "verde";

    const GAMAS = [
        self::GAMA_AMARILLO,
        self::GAMA_AZUL,
        self::GAMA_BLANCO,
        self::GAMA_GRIS,
        self::GAMA_MARRON,
        self::GAMA_MORADO,
        self::GAMA_NARANJA,
        self::GAMA_NEGRO,
        self::GAMA_ROJO,
        self::GAMA_ROSA,
        self::GAMA_VERDE
    ];

    // Enum 'estado'
    const ESTADO_DISPONIBLE = "disponible";
    const ESTADO_VENDIDO    = "vendido";

    const ESTADOS = [
        self::ESTADO_DISPONIBLE,
        self::ESTADO_VENDIDO
    ];
}
