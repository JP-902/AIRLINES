<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        $clientes = Cliente::all();
        $empleados = Empleado::all();

        return view('pedido.index', compact('pedidos', 'clientes', 'empleados'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'numero_pedido' => 'required|string|max:20|unique:pedidos,numero_pedido',
            'fecha_pedido' => 'required|date',
            'fecha_entrega' => 'nullable|date|after_or_equal:fecha_pedido',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'observaciones' => 'nullable|string'
        ]);

        Pedido::create($validated);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido registrado');
    }

    public function show(Pedido $pedido)
    {
        //
    }

    public function edit(Pedido $pedido)
    {
        //
    }

    public function update(Request $request, $pedido)
    {
        $pedidos = Pedido::findOrFail($pedido);

        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'empleado_id' => 'required|exists:empleados,id',
            'numero_pedido' => 'required|string|max:20|unique:pedidos,numero_pedido,' . $pedido,
            'fecha_pedido' => 'required|date',
            'fecha_entrega' => 'nullable|date|after_or_equal:fecha_pedido',
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:pendiente,en_proceso,completado,cancelado',
            'observaciones' => 'nullable|string'
        ]);

        $pedidos->update($validated);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado');
    }

    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado');
    }
}
