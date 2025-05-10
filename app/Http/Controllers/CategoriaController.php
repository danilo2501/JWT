<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categorias = Categoria::orderBy('nombre')->get();
            return view('categorias.index', compact('categorias'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al cargar las categorías: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        try {
            Categoria::create($request->all());
            return redirect()->route('categorias.index')
                            ->with('success', 'Categoría creada exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                         ->with('error', 'Error al crear categoría: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        try {
            $categoria->update($request->all());
            return redirect()->route('categorias.index')
                            ->with('success', 'Categoría actualizada exitosamente');
        } catch (\Exception $e) {
            return back()->withInput()
                         ->with('error', 'Error al actualizar: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('categorias.index')
                            ->with('success', 'Categoría eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}