<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $categorias = Categoria::orderBy('nombre')->get();
            return view('categorias.index', compact('categorias'));
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')
                           ->with('error', 'Error al cargar las categorías. Por favor intente nuevamente.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        
        try {
            Categoria::create($validatedData);
            DB::commit();
            
            return redirect()->route('categorias.index')
                            ->with('success', 'Categoría creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                        ->with('error', 'No se pudo crear la categoría. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\View\View
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\View\View
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,'.$categoria->id,
            'descripcion' => 'nullable|string|max:500'
        ]);

        DB::beginTransaction();
        
        try {
            $categoria->update($validatedData);
            DB::commit();
            
            return redirect()->route('categorias.index')
                           ->with('success', 'Categoría actualizada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                       ->with('error', 'No se pudo actualizar la categoría. Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Categoria $categoria)
    {
        DB::beginTransaction();
        
        try {
            $categoria->delete();
            DB::commit();
            
            return redirect()->route('categorias.index')
                           ->with('success', 'Categoría eliminada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'No se pudo eliminar la categoría. Error: ' . $e->getMessage());
        }
    }
}