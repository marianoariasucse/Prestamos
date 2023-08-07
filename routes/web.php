<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');

    Route::get('prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('prestamos/{id}', [PrestamoController::class, 'show'])->name('prestamos.show');
});
