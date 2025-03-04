<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\retalController;

Route::get('/retales', [retalController::class, 'index']);

Route::get('/retales/{id}', [retalController::class, 'show'] );

Route::post('/retales', [retalController::class, 'store']);

Route::put('/retales/{id}', [retalController::class, 'update']);

Route::patch('/retales/{id}', [retalController::class, 'updatePartial']);

Route::delete('/retales/{id}', [retalController::class, 'destroy']);




