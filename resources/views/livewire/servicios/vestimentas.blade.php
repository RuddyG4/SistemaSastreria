<x-slot:title>
    Vestimentas
    </x-slot>

    <div>

    <h1>Vista de vestimentas</h1>

    <h2>Agregar nueva vestimenta</h2>
    <form form wire:submit.prevent="store" id="form-id">

            <div class="input-group mb-3">
                <input wire:model="nombre" placeholder="Agregar vestimenta" type="text" class="form-control" aria-label="Text input with dropdown button">

                <select class="form-select " id="genero" wire:model="genero">
                    <option value="1">Hombre</option>
                    <option value="0">Mujer</option>
                </select>


                <button type="submit" form="form-id" class="btn btn-primary" @if (empty($nombre))disabled @endif>Guardar</button>

            </div>
        </form>

        <h2>Lista de vestimentas</h2>
        <div class="row">
            <div class="col">
                <input wire:model="busqueda" class="form-control col-md-6" type="text" placeholder="Buscar...">
            </div>
        </div>
        <br>

        <div class="ibox-content">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Género</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listVestimenta as $list)
                    <tr>
                        <td>
                            @if ($list->id == $id_vestimenta)
                            <input type="text" class="form-control" wire:model="nombreEdit">
                            @error('nombreEdit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @else
                            {{ $list->nombre }}
                            @endif
                        </td>
                        <td>
                            @if ($list->id == $id_vestimenta)
                            <select class="form-select" wire:model="generoEdit">
                                <option value="0">Mujer</option>
                                <option value="1">Hombre</option>
                            </select>
                            @error('generoEdit')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror


                            @else
                            @if ($list->genero == 0)
                            <span class="badge text-bg-danger">Mujer</span>
                            @else
                            <span class="badge text-bg-primary">Hombre</span>
                            @endif
                            @endif
                        </td>
                        <td>
                            @if ($list->id == $id_vestimenta)
                            <div>
                                <button class="btn btn-success" wire:click="update">Guardar</button>
                                <button class="btn btn-secondary" wire:click="cancelEdit">Cancelar</button>
                            </div>
                            @else
                            <button class="btn btn-primary" wire:click="edit({{ $list->id }})">Editar</button>
                            <button class="btn btn-danger" wire:click="disactivate({{ $list->id }})">Deshabilitar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if( $listVestimenta->hasPages() )
            <div class="px-6 py-3">
                {{ $listVestimenta->links() }}
            </div>
            @endif
        </div>





        <div wire:ignore.self id="modalVista" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newMaterial" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newMaterial">Vestimentas Deshabilitadas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>nombre</th>
                                    <th>genero</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listDeHabilitada as $listH)
                                <tr>
                                    <td> {{$listH->nombre}}</td>
                                    <td>
                                        @if ($listH->genero == 0)
                                        <span class="badge text-bg-danger">Mujer</span>
                                        @else
                                        <span class="badge text-bg-primary">Hombre</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#modalDarBaja" class="btn btn-danger" wire:click="activate({{$listH->id}})">Habilitar</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="close"> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-auto">
            <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalVista">Deshabilitado</button>
        </div>
    </div>


    @push('scripts')
    <script>
        window.addEventListener('cerrar-modal-vista', event => {
            $('#modalVista').modal('hide');
        });
    </script>
    @endpush