<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    @vite(['resources/js/app.js'])
</head>
<body>

<div class="card">
    <div class="card-body">

        <button type="button" class="btn-solid theme-primary"
            data-bs-toggle="dialog" data-bs-target="#exampleDialog">
            Agregar Pedido
        </button>

        <dialog class="dialog" id="exampleDialog">
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf

                <div class="dialog-header">
                    <h1 class="dialog-title">Información de Pedido</h1>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="dialog"></button>
                </div>

                <div class="dialog-body">

                    <div class="form-field">
                        <label class="form-label">Cliente</label>
                        <select class="form-control" name="cliente_id">
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}">
                                    {{ $cliente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Empleado</label>
                        <select class="form-control" name="empleado_id">
                            @foreach ($empleados as $empleado)
                                <option value="{{ $empleado->id }}">
                                    {{ $empleado->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Número de pedido</label>
                        <input class="form-control" name="numero_pedido">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Fecha del pedido</label>
                        <input type="date" class="form-control"
                            name="fecha_pedido">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Fecha de entrega</label>
                        <input type="date" class="form-control"
                            name="fecha_entrega">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Total</label>
                        <input type="number" step="0.01" min="0"
                            class="form-control" name="total" value="0">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Estado</label>
                        <select class="form-control" name="estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En proceso</option>
                            <option value="completado">Completado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control"
                            name="observaciones"></textarea>
                    </div>

                </div>

                <div class="dialog-footer">
                    <button type="button" class="btn-solid theme-secondary"
                        data-bs-dismiss="dialog">Cerrar</button>
                    <button type="submit" class="btn-solid theme-primary">
                        Agregar Pedido
                    </button>
                </div>
            </form>
        </dialog>
    </div>
</div>

<table class="table table-striped-columns">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Número</th>
            <th>Fecha pedido</th>
            <th>Fecha entrega</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Editar</th>
        </tr>
    </thead>

    @forelse ($pedidos as $pedido)
        <tbody>
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $clientes->firstWhere('id', $pedido->cliente_id)?->nombre }}</td>
                <td>{{ $empleados->firstWhere('id', $pedido->empleado_id)?->nombre }}</td>
                <td>{{ $pedido->numero_pedido }}</td>
                <td>{{ $pedido->fecha_pedido }}</td>
                <td>{{ $pedido->fecha_entrega }}</td>
                <td>{{ $pedido->total }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>{{ $pedido->observaciones }}</td>

                <td>
                    <button type="button" class="btn-solid theme-primary"
                        data-bs-toggle="dialog"
                        data-bs-target="#modalPedido{{ $pedido->id }}">
                        Editar
                    </button>

                    <dialog class="dialog"
                        id="modalPedido{{ $pedido->id }}">

                        <div class="dialog-header">
                            <h1 class="dialog-title">Editar Pedido</h1>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="dialog"></button>
                        </div>

                        <form action="{{ route('pedidos.update', $pedido->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="dialog-body">

                                <div class="form-field">
                                    <label class="form-label">Cliente</label>
                                    <select class="form-control" name="cliente_id">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Empleado</label>
                                    <select class="form-control" name="empleado_id">
                                        @foreach ($empleados as $empleado)
                                            <option value="{{ $empleado->id }}"
                                                {{ $pedido->empleado_id == $empleado->id ? 'selected' : '' }}>
                                                {{ $empleado->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Número de pedido</label>
                                    <input class="form-control" name="numero_pedido"
                                        value="{{ $pedido->numero_pedido }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Fecha del pedido</label>
                                    <input type="date" class="form-control"
                                        name="fecha_pedido"
                                        value="{{ $pedido->fecha_pedido }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Fecha de entrega</label>
                                    <input type="date" class="form-control"
                                        name="fecha_entrega"
                                        value="{{ $pedido->fecha_entrega }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Total</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control" name="total"
                                        value="{{ $pedido->total }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Estado</label>
                                    <select class="form-control" name="estado">
                                        <option value="pendiente"
                                            {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>
                                            Pendiente
                                        </option>
                                        <option value="en_proceso"
                                            {{ $pedido->estado == 'en_proceso' ? 'selected' : '' }}>
                                            En proceso
                                        </option>
                                        <option value="completado"
                                            {{ $pedido->estado == 'completado' ? 'selected' : '' }}>
                                            Completado
                                        </option>
                                        <option value="cancelado"
                                            {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>
                                            Cancelado
                                        </option>
                                    </select>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Observaciones</label>
                                    <textarea class="form-control"
                                        name="observaciones">{{ $pedido->observaciones }}</textarea>
                                </div>

                            </div>

                            <div class="dialog-footer">
                                <button type="button"
                                    class="btn-solid theme-secondary"
                                    data-bs-dismiss="dialog">Cerrar</button>
                                <button type="submit"
                                    class="btn-solid theme-primary">
                                    Guardar cambios
                                </button>
                            </div>
                        </form>
                    </dialog>

                    <form action="{{ route('pedidos.destroy', $pedido->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-solid theme-primary">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>
    @empty
        <p>No hay registros de pedidos</p>
    @endforelse
</table>

</body>
</html>
