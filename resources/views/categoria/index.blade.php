
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
                Agregar Categoría
            </button>

            <dialog class="dialog" id="exampleDialog">

                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf

                    <div class="dialog-header">
                        <h1 class="dialog-title">Información de Categoría</h1>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="dialog"></button>
                    </div>

                    <div class="dialog-body">

                        <div class="form-field">
                            <label class="form-label">Nombre</label>
                            <input class="form-control" name="nombre"
                                value="{{ old('nombre') }}">
                        </div>

                        <div class="form-field">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control"
                                name="descripcion">{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label class="form-label">Estado</label>
                            <select class="form-control" name="estado">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                    </div>

                    <div class="dialog-footer">
                        <button type="button" class="btn-solid theme-secondary"
                            data-bs-dismiss="dialog">Cerrar</button>

                        <button type="submit" class="btn-solid theme-primary">
                            Agregar Categoría
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
                <th>Estado</th>
                <th>Editar</th>
            </tr>
        </thead>

        @forelse ($categorias as $categoria)

            <tbody>
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>{{ $categoria->estado }}</td>

                    <td>
                        <div class="btn-group">

                            <button type="button" class="btn-solid theme-primary"
                                data-bs-toggle="dialog"
                                data-bs-target="#modalCategoria{{ $categoria->id }}">
                                Editar
                            </button>

                            <dialog class="dialog"
                                id="modalCategoria{{ $categoria->id }}">

                                <div class="dialog-header">
                                    <h1 class="dialog-title">Editar Categoría</h1>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="dialog"></button>
                                </div>

                                <form action="{{ route('categorias.update', $categoria->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="dialog-body">

                                        <div class="form-field">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control" name="nombre"
                                                value="{{ $categoria->nombre }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Descripción</label>
                                            <textarea class="form-control"
                                                name="descripcion">{{ $categoria->descripcion }}</textarea>
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Estado</label>
                                            <select class="form-control" name="estado">
                                                <option value="activo"
                                                    {{ $categoria->estado == 'activo' ? 'selected' : '' }}>
                                                    Activo
                                                </option>

                                                <option value="inactivo"
                                                    {{ $categoria->estado == 'inactivo' ? 'selected' : '' }}>
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

                            <form action="{{ route('categorias.destroy', $categoria->id) }}"
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
            <p>No hay registros de categorías</p>
        @endforelse

    </table>

</body>
</html>
