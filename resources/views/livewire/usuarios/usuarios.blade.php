<x-slot:title>
    Usuarios
    </x-slot>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h3><strong>Vista de usuarios</strong></h3>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <input wire:model="busqueda" class="form-control" type="text" placeholder="Buscar...">
                </div>
                @if(in_array('bitacora.lista', $permisos))
                <div class="col-auto">
                    <a href="{{ url('/dashboard/adm_usuarios/bitacora') }}" class="btn btn-success btn-sm"><i class="fa fa-book"></i> Bitacora</a>
                </div>
                @endif
                @if(in_array('usuario.crear', $permisos))
                <div class="col-auto">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeCreacion"><i class="fa fa-user-plus"></i> Crear usuario</button>
                </div>
                @endif
            </div>
            <br>

            <div class="ibox-content">
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
                            @if(in_array('usuario.modificar', $permisos) || in_array('usuario.inhabilitar', $permisos))
                            <th>Opciones</th>
                            @endif
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
                                @if(in_array('usuario.modificar', $permisos))
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar( {{ $usuario->id }} )"><i class="fa fa-edit"></i>Editar</button>
                                @endif
                                @if(in_array('usuario.inhabilitar', $permisos))
                                <button class="btn btn-danger btn-sm" wire:click="$emit('confirmarBaja', {{ $usuario->id}} )"><i class="fa fa-trash"></i> Dar baja</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($usuarios->hasPages())
                <div class="px-6 py-3">
                    {{ $usuarios->links() }}
                </div>
                @endif
            </div>
        </div>

        <!-- Modales -->

        <!-- Modal de creacion -->
        <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="crearUsuario">Crear usuario</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Rellene los datos:</h4>
                        <form wire:submit.prevent="store" id="form-id">
                            @csrf
                            <label for="nombre"><strong>Nombre :</strong></label>
                            <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="apellido"><strong>Apellido :</strong></label>
                            <input type="text" id="apellido" class="form-control" wire:model.lazy="apellido">
                            @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="ci"><strong>C.I. :</strong></label>
                            <input type="number" id="ci" class="form-control" wire:model="ci">
                            @error('ci')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="username"><strong>Nombre de usuario :</strong></label>
                            <input type="text" id="username" class="form-control" wire:model="username">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="email"><strong>Correo :</strong></label>
                            <input type="email" id="email" class="form-control" wire:model="email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="rol"><strong>Rol :</strong></label>
                            <select wire:model="id_rol" class="form-control" id="rol">
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_rol')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="password"><strong>Contraseña :</strong></label>
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
                        <h3 class="modal-title" id="editarUsuario">Editar usuario</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Actualice los datos:</h4>
                        <form wire:submit.prevent="update" id="editing-form">
                            @csrf
                            <label for="nombre-edit"><strong>Nombre :</strong></label>
                            <input type="text" id="nombre-edit" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="apellido-edit"><strong>Apellido :</strong></label>
                            <input type="text" id="apellido-edit" class="form-control" wire:model.lazy="apellido">
                            @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="ci-edit"><strong>C.I. :</strong></label>
                            <input type="number" id="ci-edit" class="form-control" wire:model.lazy="ci">
                            @error('ci')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="username-edit"><strong>Nombre de usuario :</strong></label>
                            <input type="text" id="username-edit" class="form-control" wire:model.lazy="username">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="email-edit"><strong>Correo :</strong></label>
                            <input type="email" id="email-edit" class="form-control" wire:model.debounce.500ms="email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="rol-edit"><strong>Rol :</strong></label>
                            <select wire:model="id_rol" class="form-control" id="rol-edit">
                                @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                            @error('id_rol')
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

    <script>
        Livewire.on('confirmarBaja', id => {
            Swal.fire({
                title: '¿Está seguro?',
                text: "El usuario seleccionado ya no podrá acceder al sistema",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC4758',
                cancelButtonColor: '#808991',
                confirmButtonText: 'Sí, dar de baja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('usuarios.usuarios', 'darBaja', id);
                    Swal.fire(
                        'Usuario inactivo!',
                        'El usuario seleccionado ha sido dado de baja.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('usuarioActualizado', function() {
            Swal.fire(
                'Usuario actualizado!',
                'Los cambios se guardaron correctamente!',
                'success'
            )
        })

        Livewire.on('usuarioCreado', function() {
            Swal.fire(
                'Usuario creado!',
                'El Usuario ha sido creado correctamente!',
                'success'
            )
        })
    </script>
    @endpush