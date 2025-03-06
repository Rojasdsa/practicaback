<?php

namespace App\Models;

use Database\Factories\RetalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retal extends Model
{
    use HasFactory;

    public static function newFactory():RetalFactory
    {
        return new RetalFactory();
    }

    const ESTADO_DISPONIBLE = "Disponible";
    const ESTADO_VENDIDO    = "Vendido";

    const ESTADOS = [
        self::ESTADO_DISPONIBLE,
        self::ESTADO_VENDIDO
    ];

    protected $table = 'retales';

    protected $fillable = [
        'nombre',
        'metros',
        'precio',
        'image'
    ];
}