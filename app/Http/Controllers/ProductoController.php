<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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

class ProductoController extends Controller
{
    // INDEX
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // CREATE
    public function create()
    {
        return view('productos.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_por_metro' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $producto = Producto::create($validated);

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    // SHOW
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // EDIT
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    // UPDATE
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_por_metro' => 'required|numeric',
            'stock' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $producto->update($validated);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // DESTROY
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}
