<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retal extends Model
{
    use HasFactory;

    protected $table = 'retales';

    protected $fillable = [
        'nombre',
        'metros',
        'precio',
        'image'
    ];
}