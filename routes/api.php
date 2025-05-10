<?php

use Illuminate\Support\Facades\Route;

// Controladores de recursos
use App\Http\Controllers\ApiProductoController;
use App\Http\Controllers\ApiCategoriaController;

// Controlador de autenticación
use App\Http\Controllers\Api\AuthController;

// Rutas públicas (registro y login)
Route::post('/registrar', [AuthController::class, 'register']);
Route::post('/iniciar-sesion', [AuthController::class, 'login']);

// Rutas protegidas por JWT
Route::middleware('auth:api')->group(function () {

    // Rutas de autenticación protegidas
    Route::post('/cerrar-sesion', [AuthController::class, 'logout']);
    Route::get('/usuario-autenticado', [AuthController::class, 'me']);

    // Recursos protegidos
    Route::apiResource('productos', ApiProductoController::class);
    Route::apiResource('categorias', ApiCategoriaController::class);
});
