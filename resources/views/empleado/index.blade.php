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
            Agregar Empleado
        </button>

        <dialog class="dialog" id="exampleDialog">
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf

                <div class="dialog-header">
                    <h1 class="dialog-title">Información de Empleado</h1>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="dialog"></button>
                </div>

                <div class="dialog-body">

                    <div class="form-field">
                        <label class="form-label">Código</label>
                        <input class="form-control" name="codigo"
                            value="{{ old('codigo') }}">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre"
                            value="{{ old('nombre') }}">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Email</label>
                        <input class="form-control" name="email"
                            value="{{ old('email') }}">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Cargo</label>
                        <input class="form-control" name="cargo"
                            value="{{ old('cargo') }}">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Fecha de contratación</label>
                        <input type="date" class="form-control"
                            name="fecha_contratacion"
                            value="{{ old('fecha_contratacion') }}">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Estado</label>
                        <select class="form-control" name="estado">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>

                </div>

                <div class="dialog-footer">
                    <button type="button" class="btn-solid theme-secondary"
                        data-bs-dismiss="dialog">Cerrar</button>
                    <button type="submit" class="btn-solid theme-primary">
                        Agregar Empleado
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
            <th>Código</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Cargo</th>
            <th>Fecha contratación</th>
            <th>Estado</th>
            <th>Editar</th>
        </tr>
    </thead>

    @forelse ($empleados as $empleado)
        <tbody>
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->codigo }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->cargo }}</td>
                <td>{{ $empleado->fecha_contratacion }}</td>
                <td>{{ $empleado->estado }}</td>

                <td>
                    <div class="btn-group">

                        <button type="button" class="btn-solid theme-primary"
                            data-bs-toggle="dialog"
                            data-bs-target="#modalEmpleado{{ $empleado->id }}">
                            Editar
                        </button>

                        <dialog class="dialog"
                            id="modalEmpleado{{ $empleado->id }}">

                            <div class="dialog-header">
                                <h1 class="dialog-title">Editar Empleado</h1>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="dialog"></button>
                            </div>

                            <form action="{{ route('empleados.update', $empleado->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="dialog-body">

                                    <div class="form-field">
                                        <label class="form-label">Código</label>
                                        <input class="form-control" name="codigo"
                                            value="{{ $empleado->codigo }}">
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Nombre</label>
                                        <input class="form-control" name="nombre"
                                            value="{{ $empleado->nombre }}">
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" name="email"
                                            value="{{ $empleado->email }}">
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Cargo</label>
                                        <input class="form-control" name="cargo"
                                            value="{{ $empleado->cargo }}">
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Fecha de contratación</label>
                                        <input type="date" class="form-control"
                                            name="fecha_contratacion"
                                            value="{{ $empleado->fecha_contratacion }}">
                                    </div>

                                    <div class="form-field">
                                        <label class="form-label">Estado</label>
                                        <select class="form-control" name="estado">
                                            <option value="activo"
                                                {{ $empleado->estado == 'activo' ? 'selected' : '' }}>
                                                Activo
                                            </option>
                                            <option value="inactivo"
                                                {{ $empleado->estado == 'inactivo' ? 'selected' : '' }}>
                                                Inactivo
                                            </option>
                                        </select>
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

                        <form action="{{ route('empleados.destroy', $empleado->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-solid theme-primary">
                                Eliminar
                            </button>
                        </form>

                    </div>
                </td>
            </tr>
        </tbody>
    @empty
        <p>No hay registros de empleados</p>
    @endforelse
</table>

</body>
</html>
