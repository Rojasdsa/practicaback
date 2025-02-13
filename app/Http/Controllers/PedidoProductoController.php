<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

/*
index: Muestra los productos asociados a un pedido.

    El método obtiene los productos relacionados con el pedido a través de la relación productos() y los pasa a la vista.

store: Agrega un producto a un pedido.

    Recibe los datos del producto y la cantidad desde el formulario de la vista. Valida los datos y luego agrega el producto al pedido 
    a través de la tabla pivote pedido_producto.

update: Actualiza la cantidad de un producto en un pedido.

    Usando el método updateExistingPivot(), puedes modificar la cantidad del producto en el pedido sin cambiar otros valores.

destroy: Elimina un producto de un pedido.

    Esto se realiza a través del método detach(), que elimina la relación entre el pedido y el producto en la tabla pivote pedido_producto.
*/

class PedidoProductoController extends Controller
{
    // INDEX
    public function index(Pedido $pedido)
    {
        $productos = $pedido->productos;
        return view('pedidos.productos.index', compact('pedido', 'productos'));
    }

    // STORE
    public function store(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:1',
        ]);

        // Añadir el producto al pedido (con la cantidad)
        $pedido->productos()->attach($validated['producto_id'], ['cantidad' => $validated['cantidad']]);

        return redirect()->route('pedidos.productos.index', $pedido)->with('success', 'Producto agregado al pedido.');
    }

    // UPDATE
    public function update(Request $request, Pedido $pedido, Producto $producto)
    {
        $validated = $request->validate([
            'cantidad' => 'required|numeric|min:1',
        ]);

        // Actualizar la cantidad del producto en la tabla pivote
        $pedido->productos()->updateExistingPivot($producto->id, ['cantidad' => $validated['cantidad']]);

        return redirect()->route('pedidos.productos.index', $pedido)->with('success', 'Cantidad del producto actualizada.');
    }

    // DESTROY
    public function destroy(Pedido $pedido, Producto $producto)
    {
        // Eliminar el producto de la tabla pivote
        $pedido->productos()->detach($producto->id);

        return redirect()->route('pedidos.productos.index', $pedido)->with('success', 'Producto eliminado del pedido.');
    }
}
