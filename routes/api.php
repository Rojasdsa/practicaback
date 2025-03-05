<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RetalController;

Route::get('/retales', [RetalController::class, 'index']);

Route::get('/retales/{id}', [RetalController::class, 'show']);

Route::post('/retales', [RetalController::class, 'store']);

Route::put('/retales/{id}', [RetalController::class, 'update']);

Route::patch('/retales/{id}', [RetalController::class, 'updatePartial']);

Route::delete('/retales/{id}', [RetalController::class, 'destroy']);
