<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use Illuminate\Http\Request;

class BodegaController extends Controller
{
    public function index()
    {
        $bodegas = Bodega::all();

        return view('bodega.index', compact('bodegas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:bodegas,codigo',
        ]);

        Bodega::create($validated);

        return redirect()->route('bodegas.index')
            ->with('success', 'Bodega registrada correctamente');
    }

    public function show(Bodega $bodega)
    {
        //
    }

    public function edit(Bodega $bodega)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $bodega = Bodega::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'codigo' => 'required|string|max:255|unique:bodegas,codigo,' . $id,
        ]);

        $bodega->update($validated);

        return redirect()->route('bodegas.index')
            ->with('success', 'Bodega actualizada correctamente');
    }

    public function destroy($id)
    {
        $bodega = Bodega::findOrFail($id);

        $bodega->delete();

        return redirect()->route('bodegas.index')
            ->with('success', 'Bodega eliminada correctamente');
    }
}