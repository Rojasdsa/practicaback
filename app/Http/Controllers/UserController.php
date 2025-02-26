<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

/* 
index: Muestra el listado de elementos (productos, usuarios, pedidos).
create: Muestra el formulario para crear un nuevo elemento.
store: Valida y guarda el nuevo elemento en la base de datos.
show: Muestra los detalles de un elemento.
edit: Muestra el formulario para editar un elemento existente.
update: Valida y actualiza los datos de un elemento.
destroy: Elimina un elemento de la base de datos.
*/

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    // INDEX
    public function index(): View
    {
        $users = User::paginate();
        return view('users.index', compact('users'));
    }

    /*
    // CREATE
    public function create()
    {
        return view('users.create');
    }

    // STORE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'direccion' => 'nullable|string',
            'telefono' => 'nullable|string',
        ]);

        $user = User::create([
            'nombre' => $validated['nombre'],
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // SHOW
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // EDIT
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
        ]);

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    // DESTROY
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
        */
}
