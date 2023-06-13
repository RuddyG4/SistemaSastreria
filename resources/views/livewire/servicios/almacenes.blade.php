<x-slot:title>
    Almacen
    </x-slot>

<div>

    <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Nuevo Almacen</button>

    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>ubicacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($almacenes as $almacen)
            <tr>
                <td>{{ $almacen->nombre }}</td>
                <td>{{ $almacen->ubicacion }}</td>
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalDeEditar" class="btn btn-primary" wire:click="editar({{$almacen->id}})">Editar</button>
                    <button data-bs-toggle="modal" data-bs-target="#modalDeDelete" class="btn btn-danger" wire:click="$set('idAlma', {{ $almacen->id }})">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newAlma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newAlma">Nuevo Alamacen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="ubicacion">Ubicacion</label>
                        <input type="text" id="ubicacion" class="form-control" wire:model.lazy="ubicacion">
                        @error('ubicacion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self id="modalDeDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eliminarAlma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarAlma">Eliminar Almacen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h2>Seguro que quieres eliminar este almacen?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cerrar">Cancelar</button>
                    <button id="eliminar" type="button" class="btn btn-secondary" wire:click="delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self id="modalDeEditar" class="modal fade" tabindex="1" role="dialog" aria-labelledby="editarAlma" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editarAlma">Editar Almacen</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">

                    <form wire:submit.prevent="update" id="form-edit">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="ubicacion">Ubicacion</label>
                        <input type="text" id="ubicacion" class="form-control" wire:model.lazy="ubicacion">
                        @error('ubicacion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form-edit">Guardar</button>
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cancelar</button>

                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')
    <script>
        window.addEventListener('cerrar-modal-crear', event => {
            $('#modalDeCreacion').modal('hide');
        });
        window.addEventListener('cerrar-modal-eliminar', event => {
            $('#modalDeDelete').modal('hide');
        });
        window.addEventListener('cerrar-modal-editar', event => {
            $('#modalDeEditar').modal('hide');
        });
    </script>
    @endpush