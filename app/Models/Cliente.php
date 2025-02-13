<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'primer_apellido', 'segundo_apellido', 'email', 'password', 'direccion', 'telefono'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
