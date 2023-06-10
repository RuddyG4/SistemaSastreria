<x-slot:title>
    Clientes
    </x-slot>
    <div>
        <h1>Vista de clientes</h1>
        <input wire:model="busqueda" type="text" placeholder="Buscar...">
        @if(Auth::user()->tieneFuncionalidad('cliente.crear'))
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Añadir cliente</button>
        @endif

        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">C.I.</th>
                        <th scope="col">Dirección</th>
                        @if(Auth::user()->tieneFuncionalidad('funcionalidad.modificar') || Auth::user()->tieneFuncionalidad('funcionalidad.eliminar'))
                        <th scope="col">Opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->persona->nombre }}</td>
                        <td>{{ $cliente->persona->apellido }}</td>
                        <td>{{ $cliente->persona->ci }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            @if(Auth::user()->tieneFuncionalidad('funcionalidad.modificar'))
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar({{ $cliente->id }})">Editar</button>
                            @endif
                            @if(Auth::user()->tieneFuncionalidad('funcionalidad.eliminar'))
                            <button class="btn btn-danger" wire:click="$emit('confirmarEliminacion', {{ $cliente->id}} )">Eliminar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modales -->

        <!-- Modal de creacion -->
        <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearCliente" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearCliente">Crear cliente</h5>
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

                            <label for="direccion">Dirección</label>
                            <input type="text" id="direccion" class="form-control" wire:model="direccion">
                            @error('direccion')
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
        <div wire:ignore.self id="modalDeEdicion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarCliente" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCliente">Editar cliente</h5>
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

                            <label for="direccion-edit">Dirección</label>
                            <input type="text" id="direccion-edit" class="form-control" wire:model.lazy="direccion">
                            @error('direccion')
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
        Livewire.on('confirmarEliminacion', id => {
            Swal.fire({
                title: '¿Está seguro?',
                text: "El cliente seleccionado será eliminado",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC4758',
                cancelButtonColor: '#808991',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('servicios.clientes', 'delete', id);
                    Swal.fire(
                        'Cliente eliminado!',
                        'El cliente ha sido eliminado.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('clienteActualizado', function() {
            Swal.fire(
                'Cliente actualizado!',
                'Los cambios se guardaron correctamente!',
                'success'
            )
        })

        Livewire.on('clienteCreado', function() {
            Swal.fire(
                'Cliente creado!',
                'El cliente ha sido creado correctamente!',
                'success'
            )
        })
    </script>
    @endpush