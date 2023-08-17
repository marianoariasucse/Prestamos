<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\PagoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/register', function () {
    abort(403, 'El registro está cerrado.');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

    Route::get('prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('prestamos/{id}', [PrestamoController::class, 'show'])->name('prestamos.show');
    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');

    Route::get('pagos/{id}/edit', [PagoController::class, 'edit'])->name('pagos.edit');
    Route::put('pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
});
