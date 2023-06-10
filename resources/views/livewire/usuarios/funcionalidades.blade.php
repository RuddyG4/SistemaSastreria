<x-slot:title>
    Funcionalidades
    </x-slot>
    <div>
        <h1>Vista de usuarios</h1>
        <input wire:model="busqueda" type="text" placeholder="Buscar...">
        @if(Auth::user()->tieneFuncionalidad('funcionalidad.crear'))
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Crear funcionalidad</button>
        @endif

        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de funcionalidad</th>
                        <th>Descripción</th>
                        @if(Auth::user()->tieneFuncionalidad('funcionalidad.modificar') || Auth::user()->tieneFuncionalidad('funcionalidad.eliminar'))
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
                            @if(Auth::user()->tieneFuncionalidad('funcionalidad.modificar'))
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar({{ $funcionalidad->id }})">Editar</button>
                            @endif
                            @if(Auth::user()->tieneFuncionalidad('funcionalidad.eliminar'))
                            <button class="btn btn-danger" wire:click="$emit('confirmarEliminacion', {{ $funcionalidad->id }} )">Eliminar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>

                            <label for="descripcion">Descripción</label>
                            <input type="text" id="descripcion" class="form-control" wire:model.lazy="descripcion">
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

        <!-- Modal de creacion -->
        <div wire:ignore.self id="modalDeEdicion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarFuncionalidad" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarFuncionalidad">Editar funcionalidad</h5>
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

                            <label for="descripcion-edit">Descripcion</label>
                            <input type="text" id="descripcion-edit" class="form-control" wire:model.lazy="descripcion">
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