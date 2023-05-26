<x-slot:title>
        Usuarios
</x-slot>
<div>
    <h1>Vista de usuarios</h1>
    <input wire:model="busqueda" type="text" placeholder="Buscar..." >
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Crear usuario</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>C.I.</th>
                <th>Nombre de usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->persona->nombre }}</td>
                <td>{{ $usuario->persona->apellido }}</td>
                <td>{{ $usuario->persona->ci }}</td>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol->nombre }}</td>
                <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar( {{ $usuario->id }} )">Editar</button>
                    <button class="btn btn-danger" wire:click="darBaja( {{ $usuario->id}} )">Dar baja</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modales -->

    <!-- Modal de creacion -->
    <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearUsuario">Crear usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <h6>Rellene los datos:</h6>
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" class="form-control" wire:model.lazy="apellido">
                        @error('apellido')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="ci">C.I.</label>
                        <input type="number" id="ci" class="form-control" wire:model="ci">
                        @error('ci')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="username">Nombre de usuario</label>
                        <input type="text" id="username" class="form-control" wire:model="username">
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="email">Correo</label>
                        <input type="email" id="email" class="form-control" wire:model="email">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="rol">Rol</label>
                        <select wire:model="rol" id="rol">
                            <option value="">Seleccione un rol</option>
                            @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        @error('rol')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="password">Contraseña</label>
                        <input type="password" id="password" class="form-control" wire:model.debounce.500ms="password">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de creacion -->
    <div wire:ignore.self id="modalDeEdicion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarUsuario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarUsuario">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <h6>Actualice los datos:</h6>
                    <form wire:submit.prevent="update" id="editing-form">
                        @csrf
                        <label for="nombre-edit">Nombre</label>
                        <input type="text" id="nombre-edit" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="apellido-edit">Apellido</label>
                        <input type="text" id="apellido-edit" class="form-control" wire:model.lazy="apellido">
                        @error('apellido')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="ci-edit">C.I.</label>
                        <input type="number" id="ci-edit" class="form-control" wire:model.lazy="ci">
                        @error('ci')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="username-edit">Nombre de usuario</label>
                        <input type="text" id="username-edit" class="form-control" wire:model.lazy="username">
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="email-edit">Correo</label>
                        <input type="email" id="email-edit" class="form-control" wire:model.debounce.500ms="email">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="rol-edit">Rol</label>
                        <select wire:model="rol" id="rol-edit">
                            @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                        @error('rol')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                    <button type="submit" form="editing-form" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('cerrar-modal', event => {
        $('#modalDeCreacion').modal('hide');
    });
    window.addEventListener('cerrar-modal-edicion', event => {
        $('#modalDeEdicion').modal('hide');
    });
</script>
@endpush