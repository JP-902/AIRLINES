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
            Agregar Producto
        </button>

        <dialog class="dialog" id="exampleDialog">
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf

                <div class="dialog-header">
                    <h1 class="dialog-title">Información de Producto</h1>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="dialog"></button>
                </div>

                <div class="dialog-body">

                    <div class="form-field">
                        <label class="form-label">Categoría</label>
                        <select class="form-control" name="categoria_id">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Código</label>
                        <input class="form-control" name="codigo">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" name="nombre">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion"></textarea>
                    </div>

                    <div class="form-field">
                        <label class="form-label">Precio</label>
                        <input type="number" step="0.01" min="0"
                            class="form-control" name="precio">
                    </div>

                    <div class="form-field">
                        <label class="form-label">Stock</label>
                        <input type="number" min="0"
                            class="form-control" name="stock" value="0">
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
                        Agregar Producto
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
            <th>Categoría</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Editar</th>
        </tr>
    </thead>

    @forelse ($productos as $producto)
        <tbody>
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $categorias->firstWhere('id', $producto->categoria_id)?->nombre }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->descripcion }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->estado }}</td>

                <td>
                    <button type="button" class="btn-solid theme-primary"
                        data-bs-toggle="dialog"
                        data-bs-target="#modalProducto{{ $producto->id }}">
                        Editar
                    </button>

                    <dialog class="dialog"
                        id="modalProducto{{ $producto->id }}">

                        <div class="dialog-header">
                            <h1 class="dialog-title">Editar Producto</h1>
                            <button type="button" class="btn-close"
                                data-bs-dismiss="dialog"></button>
                        </div>

                        <form action="{{ route('productos.update', $producto->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="dialog-body">

                                <div class="form-field">
                                    <label class="form-label">Categoría</label>
                                    <select class="form-control" name="categoria_id">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}"
                                                {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Código</label>
                                    <input class="form-control" name="codigo"
                                        value="{{ $producto->codigo }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Nombre</label>
                                    <input class="form-control" name="nombre"
                                        value="{{ $producto->nombre }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control"
                                        name="descripcion">{{ $producto->descripcion }}</textarea>
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Precio</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control" name="precio"
                                        value="{{ $producto->precio }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Stock</label>
                                    <input type="number" min="0"
                                        class="form-control" name="stock"
                                        value="{{ $producto->stock }}">
                                </div>

                                <div class="form-field">
                                    <label class="form-label">Estado</label>
                                    <select class="form-control" name="estado">
                                        <option value="activo"
                                            {{ $producto->estado == 'activo' ? 'selected' : '' }}>
                                            Activo
                                        </option>
                                        <option value="inactivo"
                                            {{ $producto->estado == 'inactivo' ? 'selected' : '' }}>
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

                    <form action="{{ route('productos.destroy', $producto->id) }}"
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
        <p>No hay registros de productos</p>
    @endforelse
</table>

</body>
</html>
