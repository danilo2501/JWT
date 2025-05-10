<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\Api\ApiCategoriaController;

// Ruta de bienvenida (opcional si es solo API)
Route::get('/', function () {
    return view('bienvenido');
});

// Rutas web para vista de productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

// Rutas públicas de autenticación (API)
Route::post('/registrar', [AuthController::class, 'register']);
Route::post('/iniciar-sesion', [AuthController::class, 'login']);

// Rutas protegidas con JWT (API)
Route::middleware('auth:api')->group(function () {
    Route::post('/cerrar-sesion', [AuthController::class, 'logout']);
    Route::get('/usuario-autenticado', [AuthController::class, 'me']);

    Route::apiResource('productos-api', ApiProductoController::class);
    Route::apiResource('categorias-api', ApiCategoriaController::class);
});



