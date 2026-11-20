<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();

        return view('producto.index', compact('productos', 'categorias'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|string|max:20|unique:productos,codigo',
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo'
        ]);

        Producto::create($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado');
    }

    public function show(Producto $producto)
    {
        //
    }

    public function edit(Producto $producto)
    {
        //
    }

    public function update(Request $request, $producto)
    {
        $productos = Producto::findOrFail($producto);

        $validated = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|string|max:20|unique:productos,codigo,' . $producto,
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $productos->update($validated);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado');
    }
}
