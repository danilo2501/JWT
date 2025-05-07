<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ApiCategoriaController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json([
            'success' => true,
            'data' => $categorias
        ]);
    }

    // Crear nueva categoría
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $categoria = Categoria::create($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $categoria
        ], 201);
    }

    // Mostrar categoría específica
    public function show(Categoria $categoria)
    {
        return response()->json([
            'success' => true,
            'data' => $categoria
        ]);
    }

    // Actualizar categoría
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $categoria->update($request->all());
        
        return response()->json([
            'success' => true,
            'data' => $categoria
        ]);
    }

    // Eliminar categoría
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada correctamente'
        ], 204);
    }
}