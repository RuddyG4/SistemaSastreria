<x-slot:title>
    Funcionalidades
    </x-slot>
    <div>
        <h1><b>Gestion de funcionalidades</b></h1>

        <div class="row">
            <div class="col">
                <input wire:model="busqueda" class="form-control" type="text" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                @if(in_array('funcionalidad.crear', $permisos))
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Crear funcionalidad</button>
                @endif
            </div>
        </div>
        <br>

        <div class="ibox-content">
            @if($funcionalidades->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de funcionalidad</th>
                        <th>Descripción</th>
                        @if(in_array('funcionalidad.modificar', $permisos) || in_array('funcionalidad.eliminar', $permisos))
                        <th>opciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionalidades as $funcionalidad)
                    <tr>
                        <td>{{ $funcionalidad->id }}</td>
                        <td>{{ $funcionalidad->nombre }}</td>
                        <td>{{ $funcionalidad->descripcion }}</td>
                        <td>
                            @if(in_array('funcionalidad.modificar', $permisos))
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar({{ $funcionalidad->id }})">Editar</button>
                            @endif
                            @if(in_array('funcionalidad.eliminar', $permisos))
                            <button class="btn btn-danger" wire:click="$emit('confirmarEliminacion', {{ $funcionalidad->id }} )">Eliminar</button>
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
            @if( $funcionalidades->hasPages() )
            <div class="px-6 py-3">
                {{ $funcionalidades->links() }}
            </div>
            @endif
        </div>

        <!-- Modales -->

        <!-- Modal de creacion -->
        <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearFuncionalidad" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearFuncionalidad">Crear Funcionalidad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Rellene los datos:</h6>
                        <form wire:submit.prevent="store" id="form-id">
                            @csrf
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" class="form-control" wire:model="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control" wire:model.lazy="descripcion"></textarea>
                            </div>
                            @error('descripcion')
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
        <div wire:ignore.self id="modalDeEdicion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarFuncionalidad" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarFuncionalidad">Editar funcionalidad</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Actualice los datos:</h6>
                        <form wire:submit.prevent="update({{ $id_funcionalidad }})" id="editing-form">
                            @csrf
                            <label for="nombre-edit">Nombre</label>
                            <input type="text" id="nombre-edit" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <div class="form-group">
                                <label for="descripcion-edit">Descripcion</label>
                                <textarea id="descripcion-edit" class="form-control" rows="2" wire:model.lazy="descripcion"></textarea>
                            </div>
                            @error('descripcion')
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
                text: "La funcionalidad seleccionada será eliminada",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC4758',
                cancelButtonColor: '#808991',
                confirmButtonText: 'Sí, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('usuarios.funcionalidades', 'delete', id);
                    Swal.fire(
                        'Funcionalidad eliminada!',
                        'La funcionalidad ha sido eliminada.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('funcionalidadActualizada', function() {
            Swal.fire(
                'Funcionalidad Actualizada!',
                'Los cambios se guardaron correctamente!',
                'success'
            )
        })

        Livewire.on('funcionalidadCreada', function() {
            Swal.fire(
                'Funcionalidad creada!',
                'La funcionalidad ha sido creada correctamente!',
                'success'
            )
        })
    </script>
    @endpush