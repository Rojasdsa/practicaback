<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Http\Request;

/* 
index: Muestra el listado de elementos (productos, clientes, pedidos).
create: Muestra el formulario para crear un nuevo elemento.
store: Valida y guarda el nuevo elemento en la base de datos.
show: Muestra los detalles de un elemento.
edit: Muestra el formulario para editar un elemento existente.
update: Valida y actualiza los datos de un elemento.
destroy: Elimina un elemento de la base de datos.
*/

class PedidoController extends Controller
{
    // INDEX
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    // CREATE
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('pedidos.create', compact('clientes', 'productos'));
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'estado' => 'required|string',
        ]);

        $pedido = Pedido::create($validated);

        // Si tienes productos asociados, los agregas a la tabla pivote
        if ($request->has('productos')) {
            foreach ($request->productos as $producto_id => $cantidad) {
                $pedido->productos()->attach($producto_id, ['cantidad' => $cantidad]);
            }
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }

    // SHOW
    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    // EDIT
    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('pedidos.edit', compact('pedido', 'clientes', 'productos'));
    }

    // UPDATE
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'total' => 'required|numeric',
            'estado' => 'required|string',
        ]);

        $pedido->update($validated);

        // Actualizar los productos si es necesario
        if ($request->has('productos')) {
            foreach ($request->productos as $producto_id => $cantidad) {
                $pedido->productos()->updateExistingPivot($producto_id, ['cantidad' => $cantidad]);
            }
        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado exitosamente.');
    }

    // DESTROY
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado exitosamente.');
    }
}
