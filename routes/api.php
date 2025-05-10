<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\Api\ApiCategoriaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas API para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro de un grupo
| que tiene asignado el middleware "api".
|
*/

// Rutas públicas (sin autenticación)
Route::prefix('v1')->group(function () {
    // Autenticación
    Route::post('/registrar', [AuthController::class, 'registrar'])
        ->name('api.registrar');
        
    Route::post('/iniciar-sesion', [AuthController::class, 'iniciarSesion'])
        ->name('api.login');

    // Rutas protegidas (requieren JWT válido)
    Route::middleware(['auth:api', 'api.token.refresh'])->group(function () {
        // Autenticación
        Route::post('/cerrar-sesion', [AuthController::class, 'cerrarSesion'])
            ->name('api.logout');
            
        Route::get('/usuario-autenticado', [AuthController::class, 'miUsuario'])
            ->name('api.user');

        // Recursos API
        Route::apiResource('productos', ApiProductoController::class)
            ->names([
                'index' => 'api.productos.index',
                'store' => 'api.productos.store',
                // ... etc
            ]);
            
        Route::apiResource('categorias', ApiCategoriaController::class)
            ->names([
                'index' => 'api.categorias.index',
                'store' => 'api.categorias.store',
                // ... etc
            ]);
    });
});
