<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\retalController;

Route::get('/retales', [retalController::class, 'index']);

Route::post('/retales', [retalController::class, 'store']);




Route::get('/retales/{id}', function () {
    return 'Un retal';
});

Route::put('/retales/{id}', function () {
    return 'Actualizar retales';
});
Route::delete('/retales/{id}', function () {
    return 'Eliminar retales';
});
