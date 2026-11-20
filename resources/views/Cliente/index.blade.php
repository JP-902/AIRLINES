<!DOCTYPE html>

<html>

<head lang="es">

   
   
   
<link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" >
<script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" ></script>

</head>

<body>

    <nav class="navbar md:navbar-expand bg-1">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="btn-icon navbar-toggler" type="button" data-bs-toggle="drawer" data-bs-target="#navbarDrawer"
                aria-controls="navbarDrawer" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" aria-hidden="true"></span>
            </button>
            <dialog class="drawer drawer-end" tabindex="-1" id="navbarDrawer" aria-labelledby="navbarDrawerLabel">
                <div class="drawer-header">
                    <h5 class="drawer-title" id="navbarDrawerLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="drawer" aria-label="Close"></button>
                </div>
                <div class="drawer-body mb-2 md:mb-0">
                    <ul class="nav navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" type="button" data-bs-toggle="menu" aria-expanded="false">
                                Menu
                            </button>
                            <div class="menu">
                                <a class="menu-item" href="#">Action</a>
                                <a class="menu-item" href="#">Another action</a>
                                <hr class="menu-divider">
                                <a class="menu-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                    <form class="hstack gap-2" role="search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn-solid btn-icon theme-secondary" type="submit">
                            <svg class="bi" width="16" height="16">
                                <use href="#search" />
                            </svg>
                        </button>
                    </form>
                </div>
            </dialog>
        </div>
    </nav>

    <div class="card">
        <div class="card-body">
            <button type="button" class="btn-solid theme-primary" data-bs-toggle="dialog"
                data-bs-target="#exampleDialog">
                Agregar Clientes
            </button>


            <dialog class="dialog" id="exampleDialog">
            
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="dialog-header">
                        <h1 class="dialog-title">Informacion De Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="dialog" aria-label="Close"></button>
                    </div>
                    <div class="dialog-body">
                        <div class="form-field">
                            <label class="form-label">Codigo</label>
                            <input class="form-control" name='codigo' value="{{ old('codigo') }}">
                           
                        </div>
                        <div class="form-field">
                            <label class="form-label">Email</label>
                            <input class="form-control" name='email' value="{{ old('email') }}">
                          
                        </div>
                        <div class="form-field">
                            <label class="form-label">Nombre</label>
                            <input class="form-control" name='nombre' value="{{ old('nombre') }}">
                           
                        </div>
                        <div class="form-field">
                            <label class="form-label">Telefono</label>
                            <input class="form-control" name='telefono' value="{{ old('telefono') }}">
                            
                        </div>
                        <div class="form-field">
                            <label class="form-label">Direccion</label>
                            <input class="form-control" name='direccion' value="{{ old('direccion') }}">
                           

                            <select class="form-control" name="estado">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>

                        </div>
                        <div class="dialog-footer">
                            <button type="button" class="btn-solid theme-secondary"
                                data-bs-dismiss="dialog">Close</button>
                            <button type="submit" class="btn-solid theme-primary">Agregar Cliente</button>
                        </div>
                </form>
            </dialog>
        </div>
    </div>




    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Telefono</th>
                <th scope="col">Direccion</th>
                <th scope="col">Estado</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        @forelse ($clientes as $cliente)
            <tbody>
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->codigo }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->estado }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <button type="button" class="btn-solid theme-primary" data-bs-toggle="dialog"
                                data-bs-target="#modalClienteupdate{{ $cliente->id }}"
                                data-bs-modal="false">Edit</button>


                            <dialog class="dialog" id="modalClienteupdate{{ $cliente->id }}">

                                <div class="dialog-header">
                                    <h1 class="dialog-title">Información de Cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="dialog"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="dialog-body">

                                        <div class="form-field">
                                            <label class="form-label">Código</label>
                                            <input class="form-control" name="codigo"
                                                value="{{ $cliente->codigo }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" name="email"
                                                value="{{ $cliente->email }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Nombre</label>
                                            <input class="form-control" name="nombre"
                                                value="{{ $cliente->nombre }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Teléfono</label>
                                            <input class="form-control" name="telefono"
                                                value="{{ $cliente->telefono }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Dirección</label>
                                            <input class="form-control" name="direccion"
                                                value="{{ $cliente->direccion }}">
                                        </div>

                                        <div class="form-field">
                                            <label class="form-label">Estado</label>
                                            <select class="form-control" name="estado">
                                                <option value="activo"
                                                    {{ $cliente->estado == 'activo' ? 'selected' : '' }}>
                                                    Activo
                                                </option>

                                                <option value="inactivo"
                                                    {{ $cliente->estado == 'inactivo' ? 'selected' : '' }}>
                                                    Inactivo
                                                </option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="dialog-footer">
                                        <button type="button" class="btn-solid theme-secondary"
                                            data-bs-dismiss="dialog">Cerrar</button>

                                        <button type="submit" class="btn-solid theme-primary">
                                            Guardar cambios
                                        </button>
                                    </div>
                                </form>

                            </dialog>

                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-solid theme-primary">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <p>No hay registros de clientes</p>
        @endforelse
    </table>



</body>

</html>
