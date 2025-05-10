<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\Api\ApiCategoriaController;

// Rutas públicas (sin autenticación)
Route::post('/registrar', [AuthController::class, 'registrar'])->name('api.registrar');
Route::post('/iniciar-sesion', [AuthController::class, 'iniciarSesion'])->name('api.login');

// Rutas protegidas por JWT
Route::middleware('auth:api')->group(function () {
    // Rutas de autenticación protegidas
    Route::post('/cerrar-sesion', [AuthController::class, 'cerrarSesion'])->name('api.logout');
    Route::get('/usuario-autenticado', [AuthController::class, 'miUsuario'])->name('api.user');

    // Recursos protegidos
    Route::apiResource('productos', ApiProductoController::class);
    Route::apiResource('categorias', ApiCategoriaController::class);
});