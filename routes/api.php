<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RetalController;

Route::get('/retales', [RetalController::class, 'index']); // #1

Route::get('/retales/{id}', [RetalController::class, 'show']); // #2

Route::post('/retales', [RetalController::class, 'store']); // #3

Route::put('/retales/{id}', [RetalController::class, 'update']); // #4

Route::patch('/retales/{id}', [RetalController::class, 'updatePartial']); // #5

Route::delete('/retales/{id}', [RetalController::class, 'destroy']); // #6
