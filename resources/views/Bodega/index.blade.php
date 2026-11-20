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
            Agregar Bodega
        </button>

        <dialog class="dialog" id="exampleDialog">
            <form action="{{ route('bodegas.store') }}" method="POST">
                @csrf

                <div class="dialog-header">
                    <h1 class="dialog-title">Información de Bodega</h1>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="dialog"></button>
                </div>

                <div class="dialog-body">

                    <div class="form-field">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre" required>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Descripción</label>
                        <input class="form-control" name="descripcion" required>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Código</label>
                        <input class="form-control" name="codigo" required>
                    </div>

                </div>

                <div class="dialog-footer">
                    <button type="button" class="btn-solid theme-secondary"
                        data-bs-dismiss="dialog">Cerrar</button>

                    <button type="submit" class="btn-solid theme-primary">
                        Agregar Bodega
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
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Código</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>

    @forelse ($bodegas as $bodega)
        <tbody>
            <tr>
                <td>{{ $bodega->id }}</td>
                <td>{{ $bodega->nombre }}</td>
                <td>{{ $bodega->descripcion }}</td>
                <td>{{ $bodega->codigo }}</td>

                <td>
                    <button type="button" class="btn-solid theme-primary"
                        data-bs-toggle="dialog"
                        data-bs-target="#modalBodega{{ $bodega->id }}">
                        Editar
                    </button>

                    <dialog class="dialog"
                        id="modalBodega{{ $bodega->id }}">

                        <div class="dialog-header">
                            <h1 class="dialog-title">Editar Bodega</h1>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="dialog"></button>
                        </div>

                        <form action="{{ route('bodegas.update', $bodega->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="dialog-body">

                                <div class="form-field">
                                    <label class="form-label">Nombre</label>
                                    <input class="form-control" name="nombre"
                                        value="{{ $bodega->nombre }}" required>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Descripción</label>
                                    <input class="form-control" name="descripcion"
                                        value="{{ $bodega->descripcion }}" required>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Código</label>
                                    <input class="form-control" name="codigo"
                                        value="{{ $bodega->codigo }}" required>
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
                </td>

                <td>
                    <form action="{{ route('bodegas.destroy', $bodega->id) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-solid theme-primary"
                            onclick="return confirm('¿Deseas eliminar esta bodega?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        </tbody>

    @empty
        <p>No hay registros de bodegas</p>
    @endforelse
</table>

</body>
</html>
```
