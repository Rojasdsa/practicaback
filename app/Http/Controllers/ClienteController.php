<?php

namespace App\Http\Controllers;

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

class ClienteController extends Controller
{
    // INDEX
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    // CREATE
    public function create()
    {
        return view('clientes.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clientes',
            'password' => 'required|string|min:8|confirmed',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        $cliente = Cliente::create([
            'nombre' => $validated['nombre'],
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    // SHOW
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    // EDIT
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // UPDATE
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    // DESTROY
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
