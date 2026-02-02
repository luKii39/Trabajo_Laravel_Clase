<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// RUTAS DEL MÓDULO CLIENTES
Route::resource('clientes', ClienteController::class)->middleware('auth');

// RUTAS DEL MÓDULO PRODUCTOS
Route::resource('productos', ProductoController::class)->middleware('auth');

// RUTAS DEL MÓDULO VENTAS
Route::resource('ventas', VentaController::class)->middleware('auth');

// RUTAS DEL MÓDULO PROVEEDORES
Route::resource('proveedores', ProveedorController::class)->middleware('auth');

// RUTAS DEL MÓDULO COMPRAS
Route::resource('compras', CompraController::class)->middleware('auth');
