<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RetalesAdminController;
use Illuminate\Support\Facades\Route;

/* WELCOME */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/* DASHBOARD */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* PANEL ADMIN */
Route::middleware(['auth', 'can:panel admin'])->group(function () {
    Route::get('/admin/panel', function () {
        return view('admin.panel');
    })->name('admin.index');
});

Route::get('/admin/panel', [RetalesAdminController::class, 'index'])->name('admin.panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
