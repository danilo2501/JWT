<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*route product*/

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class,'create'])->name('productos.create');
Route::get('/productos/{id}',[ProductoController::class, 'show'])->name('productos.show');

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');



