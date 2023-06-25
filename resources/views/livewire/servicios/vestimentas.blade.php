<x-slot:title>
    Vestimentas
    </x-slot>

    <div>

        <h1>Vista de vestimentas</h1>
        <h2>Agregar nueva vestimenta</h2>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar vestimenta</button>


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
                            <td>{{ $list->nombre }}</td>
                            <td>
                                @if ($list->genero == 0)
                                    <span class="badge text-bg-danger">Mujer</span>
                                @else
                                    <span class="badge text-bg-primary">Hombre</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVista"
                                    wire:click="loadView({{ $list->id }})">Ver</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                    wire:click="edit({{ $list->id }})">Editar</button>
                                {{-- <button class="btn btn-danger" wire:click="disactivate({{ $list->id }})">Eliminar</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($listVestimenta->hasPages())
                <div class="px-6 py-3">
                    {{ $listVestimenta->links() }}
                </div>
            @endif
        </div>

        {{-- modal add --}}
        <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="agregarVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarVestimenta">Agregar vestimenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"
                            wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        {{ var_export($id_medida) }}
                        {{ var_export($listIdMedida) }}
                        <form form wire:submit.prevent="store" id="form-id">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h2>Nombre</h2>
                                            <input type="text" wire:model.lazy="nombre">
                                        </div>
                                        <div class="col">
                                            <h2>Genero</h2>
                                            <select wire:model.lazy="genero">
                                                <option value="">Seleccione un genero</option>
                                                <option value="1">Hombre</option>
                                                <option value="0">Mujer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h2>Medida</h2>
                                            <select class="form-control" wire:model="id_medida" wire:click="cargar">
                                                <option value="">Seleccione un genero</option>
                                                @foreach ($listMedidas as $list)
                                                    <option value="{{ $list->id }}">{{ $list->nombre }}</option>
                                                @endforeach

                                            </select>
                                            <div class="d-flex flex-wrap ">
                                                @foreach ($listMedidas as $list)
                                                    @if (!is_null($listIdMedida))
                                                        @if (in_array($list->id, $listIdMedida))
                                                            <div class="p-1">
                                                                <span class="badge badge-secundary">
                                                                    {{ $list->nombre }}
                                                                    <button type="button"
                                                                        wire:click="EliminarLista({{ $list->id }})"
                                                                        class="close btn-close btn-close-danger"
                                                                        aria-label="Dismiss">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="form-id" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-danger" wire:click="close"> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- model view --}}

        <div wire:ignore.self id="modalVista" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="VerVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VerVestimenta">Ver vestimenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"
                            wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h2>Nombre</h2>
                                        <h3 for="nombre">{{ $nombre }}</h3>
                                    </div>
                                    <div class="col">
                                        <h2>Genero</h2>
                                        @if ($genero == 0)
                                        <span class="badge text-bg-danger">Mujer</span>@else<span
                                                class="badge text-bg-primary">Hombre</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col d-flex flex-wrap">
                                        @if (!is_null($listVer))
                                            @foreach ($listVer as $list)
                                                <div class="p-1">
                                                    <span
                                                        class="badge text-bg-secondary fs-8">{{ $list }}</span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="close"> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- model edit --}}

        <div wire:ignore.self id="modalEdit" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="editVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editVestimenta">Editar vestimenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"
                            wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h2>Nombre</h2>
                                        <input type="text" wire:model="nombre" for="nombre">
                                    </div>
                                    <div class="col">
                                        <h2>Genero</h2>
                                        <select wire:model="genero">
                                            <option value="">Seleccione un genero</option>
                                            <option value="1">Hombre</option>
                                            <option value="0">mujer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col d-flex flex-wrap">
                                        <h2>Medida</h2>
                                        <select class="form-control" wire:model="id_medida" wire:click="cargar">
                                            <option value="">Seleccione un genero</option>
                                            @foreach ($listMedidas as $list)
                                                <option value="{{ $list->id }}">{{ $list->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <div class="d-flex flex-wrap ">

                                            @foreach ($listMedidas as $list)
                                                @if (!is_null($listIdMedida))
                                                    @if (in_array($list->id, $listIdMedida))
                                                        <div class="p-1">
                                                            <span class="badge badge-secundary">
                                                                {{ $list->nombre }}
                                                                <button type="button"
                                                                    wire:click="EliminarLista({{ $list->id }})"
                                                                    class="close btn-close btn-close-danger"
                                                                    aria-label="Dismiss">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="close"> Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click="update"> Guardar</button>
                    </div>
                </div>
            </div>
        </div>



    </div>


    @push('scripts')
        <script>
            window.addEventListener('cerrar-modal-vista', event => {
                $('#modalVista').modal('hide');
            });
            window.addEventListener('cerrar-modal-crear', event => {
                $('#modalAdd').modal('hide');
            });
            window.addEventListener('cerrar-modal-editar', event => {
                $('#modalEdit').modal('hide');
            });
        </script>
    @endpush
