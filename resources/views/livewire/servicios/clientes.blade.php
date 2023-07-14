<x-slot:title>
    Clientes
    </x-slot>
    <div>
        <h1><b>Vista de clientes</b></h1>
        <div class="row">
            <div class="col">
                <input wire:model="busqueda" class="form-control" type="text" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                @if(in_array('cliente.crear', $permisos))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeCreacion"><i class="fa fa-user-plus"></i> Añadir cliente</button>
                @endif
            </div>
        </div>
        <br>

        <div class="ibox-content">
        @if($clientes->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">C.I.</th>
                        <th scope="col">Dirección</th>
                        @if(in_array('cliente.modificar', $permisos) || in_array('cliente.eliminar', $permisos))
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
                        <td>
                            {{ $cliente->numero }}
                        </td>
                        <td>{{ $cliente->persona->ci }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            @if(in_array('cliente.modificar', $permisos))
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar({{ $cliente->id }})"><i class="fa fa-edit"></i> Editar</button>
                            @endif
                            @if(in_array('cliente.eliminar', $permisos))
                            <button class="btn btn-danger btn-sm" wire:click="$emit('confirmarEliminacion', {{ $cliente->id}} )"><i class="fa fa-trash"></i> Eliminar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif($busqueda != null)
            <div>
                <p><b>No existen coincidencias</b></p>
            </div>
            @else
            <div>
                <p><b>No existen datos</b></p>
            </div>
            @endif
            @if( $clientes->hasPages() )
            <div class="px-6 py-3">
                {{ $clientes->links() }}
            </div>
            @endif
            <br>
        </div>

        <!-- Modales -->

        <!-- Modal de creacion -->
        <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearCliente" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="crearCliente">Crear cliente</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Rellene los datos:</h4>
                        <form wire:submit.prevent="store" id="form-id">
                            @csrf
                            <label for="nombre"><b>Nombre :</b></label>
                            <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="apellido"><b>Apellido :</b></label>
                            <input type="text" id="apellido" class="form-control" wire:model.lazy="apellido">
                            @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="ci"><b>C.I. :</b></label>
                            <input type="number" id="ci" class="form-control" wire:model="ci">
                            @error('ci')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="direccion"><b>Dirección :</b></label>
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

        <!-- Modal de edicion -->
        <div wire:ignore.self id="modalDeEdicion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarCliente" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="editarCliente">Editar cliente</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Actualice los datos:</h4>
                        <form wire:submit.prevent="update" id="editing-form">
                            @csrf
                            <label for="nombre-edit"><b>Nombre :</b></label>
                            <input type="text" id="nombre-edit" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="apellido-edit"><b>Apellido :</b></label>
                            <input type="text" id="apellido-edit" class="form-control" wire:model.lazy="apellido">
                            @error('apellido')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="ci-edit"><b>C.I. :</b></label>
                            <input type="number" id="ci-edit" class="form-control" wire:model.lazy="ci">
                            @error('ci')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="direccion-edit"><b>Dirección :</b></label>
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