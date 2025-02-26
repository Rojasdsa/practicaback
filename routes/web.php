<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* WELCOME Y DASHBOARD */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* PANEL ADMIN */
Route::middleware(['auth', 'can:panel admin'])->group(function () {
    Route::get('/admin/panel', function () {
        return view('admin.panel');
    })->name('admin.panel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/* FRAGMENTO AÑADIDO */

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProductoController;

/*
    TABLAS PRINCIPALES
    ------------------
    Usamos Route::resource('productos', ProductoController::class); para generar automáticamente todas las rutas necesarias 
    para realizar operaciones CRUD (crear, leer, actualizar, eliminar) sobre los productos. Esto cubre las siguientes rutas:
        
        GET /productos (index)
        GET /productos/create (create)
        POST /productos (store)
        GET /productos/{producto} (show)
        GET /productos/{producto}/edit (edit)
        PUT/PATCH /productos/{producto} (update)
        DELETE /productos/{producto} (destroy)

    Se aplica de la misma forma a 'clientes' y 'pedidos'.

    TABLA PIVOTE
    ------------
    Usamos un prefijo pedidos/{pedido}, lo que significa que todas las rutas para gestionar productos dentro de un pedido 
    estarán bajo la URL /pedidos/{pedido}/productos.

    Usamos Route::resource('productos', PedidoProductoController::class) dentro del grupo de rutas 
    para gestionar las operaciones de los productos dentro de un pedido. Esto cubre:

        GET /pedidos/{pedido}/productos (index): Ver los productos asociados a un pedido.
        POST /pedidos/{pedido}/productos (store): Agregar un producto a un pedido.
        PUT/PATCH /pedidos/{pedido}/productos/{producto} (update): Actualizar la cantidad de un producto dentro de un pedido.
        DELETE /pedidos/{pedido}/productos/{producto} (destroy): Eliminar un producto de un pedido.
*/

// Rutas para gestionar productos
Route::resource('productos', ProductoController::class);

// Rutas para gestionar clientes
Route::resource('clientes', ClienteController::class);

// Rutas para gestionar pedidos
Route::resource('pedidos', PedidoController::class);

// Rutas para gestionar productos dentro de un pedido
Route::prefix('pedidos/{pedido}')->group(function () {
    Route::resource('productos', PedidoProductoController::class)->only(['index', 'store', 'update', 'destroy']);
});
