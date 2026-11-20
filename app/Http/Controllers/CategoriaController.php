<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:80|unique:categorias,nombre',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.unique' => 'Esta categoría ya existe',
            'nombre.max' => 'El nombre no puede tener más de 80 caracteres',
            'estado.required' => 'El campo estado es obligatorio',
        ]);

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría registrada');
    }

    public function show(Categoria $categoria)
    {
        //
    }

    public function edit(Categoria $categoria)
    {
        //
    }

    public function update(Request $request, $categoria)
    {
        $categorias = Categoria::findOrFail($categoria);

        $validated = $request->validate([
            'nombre' => 'required|string|max:80|unique:categorias,nombre,' . $categoria,
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $categorias->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría eliminada');
    }
}
