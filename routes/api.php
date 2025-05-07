<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiProductoController;
Route::apiResource('productos', ApiProductoController::class);
//Route
use App\Http\Controllers\ApiCategoriaController;
Route::apiResource('categorias', ApiCategoriaController::class);