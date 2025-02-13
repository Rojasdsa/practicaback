<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedido_producto'; // Especificamos la tabla pivote

    protected $fillable = ['pedido_id', 'producto_id', 'cantidad'];

    public $timestamps = true; // Laravel gestionará created_at y updated_at

    // Relaciones opcionales
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
