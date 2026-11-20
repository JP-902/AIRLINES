<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();

        return view('empleado.index', compact('empleados'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:empleados,codigo',
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:empleados,email',
            'cargo' => 'required|string|max:60',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:activo,inactivo'
        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado');
    }

    public function show(Empleado $empleado)
    {
        //
    }

    public function edit(Empleado $empleado)
    {
        //
    }

    public function update(Request $request, $empleado)
    {
        $empleados = Empleado::findOrFail($empleado);

        $validated = $request->validate([
            'codigo' => 'required|string|max:20|unique:empleados,codigo,' . $empleado,
            'nombre' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:empleados,email,' . $empleado,
            'cargo' => 'required|string|max:60',
            'fecha_contratacion' => 'required|date',
            'estado' => 'required|in:activo,inactivo'
        ]);

        $empleados->update($validated);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado');
    }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);

        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado');
    }
}
