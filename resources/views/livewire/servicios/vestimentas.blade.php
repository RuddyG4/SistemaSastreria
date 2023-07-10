<x-slot:title>
    Vestimentas
    </x-slot>

    <div>
        <!-- Inicio Widgets -->
        <div class="row">
            <div class="col-lg-4">
                <div class="widget style1" style="padding: 5px 10px !important;">
                    <div class="row">
                        <div class="col-4 text-center">
                            <i class="fa fa-trophy fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Total Vestimentas </span>
                            <h2 class="font-bold">{{$this->listDeHabilitada->count()}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget style1 blue-bg" style="padding: 5px 10px !important;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-male fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Vestimenta Hombres </span>
                            <h2 class="font-bold">{{$this->totalVestimentaHombre()}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget style1 red-bg" style="padding: 5px 10px !important;">
                    <div class="row">
                        <div class="col-4">
                            <i class="fa fa-female fa-4x"></i>
                        </div>
                        <div class="col-8 text-right">
                            <span> Vestimenta Mujeres </span>
                            <h2 class="font-bold">{{$this->totalVestimentaMujer()}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Widgets -->

        @if (in_array('vestimenta.crear', $permisosVestimenta) or in_array('medida.crear', $permisosMedida))
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Agregar Vestimenta</h5>
            </div>
            <div class="ibox-content">
                @if(in_array('vestimenta.crear', $permisosVestimenta))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar
                    vestimenta</button>
                @endif
                @if(in_array('medida.crear', $permisosMedida))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMedida">Agregar
                    Medida</button>
                @endif
            </div>
        </div>
        @endif

        <div class="ibox ">
            <div class="ibox-title">
                <h5>Lista Vestimentas</h5>
            </div>

            <div class="ibox-content">
                <input type="text" wire:model="busqueda" class="form-control form-control-sm m-b-xs" id="filter" placeholder="Buscar Vestimenta">

                <table class="footable table table-striped ">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> Nombre</th>
                            <th> Genero </th>
                            @if (in_array('vestimenta.ver', $permisosVestimenta) or in_array('vestimenta.modificar', $permisosVestimenta) or in_array('vestimenta.eliminar', $permisosVestimenta) )
                            <th class="text-center">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listVestimenta as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->nombre}}</td>
                            <td>
                                @if ($list->genero == 0)
                                <span class="badge badge-danger">Femenino</span>
                                @else
                                <span class="badge text-bg-primary">Masculino</span>
                                @endif

                            </td>
                            <td class="text-center">
                                @if (in_array('vestimenta.ver', $permisosVestimenta))
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalVista" wire:click="loadView({{ $list->id }})">Ver </button>
                                @endif
                                @if (in_array('vestimenta.modificar', $permisosVestimenta))
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="edit({{ $list->id }})">Editar </button>
                                @endif
                                @if (in_array('vestimenta.eliminar', $permisosVestimenta))
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar" wire:click="loadView({{ $list->id }})">Eliminar
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                @if ($listVestimenta->hasPages())
                <div class="px-6 py-3">
                    {{ $listVestimenta->links() }}
                </div>
                @endif
            </div>
        </div>
        {{-- modal add --}}
        <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="agregarVestimenta"><b>Agregar vestimenta</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <form form wire:submit.prevent="store" id="form-id">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h2>Nombre</h2>
                                            <input class="form-control" type="text" wire:model.lazy="nombre">
                                            @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <h2>Genero</h2>
                                            <select class="form-control" wire:model.lazy="genero">
                                                <option value="">Seleccione un genero</option>
                                                <option value="1">Hombre</option>
                                                <option value="0">Mujer</option>
                                            </select>
                                            @error('genero')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                                <option value="">Seleccione una medida</option>
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
                                                        <button type="button" wire:click="EliminarLista({{ $list->id }})" class="close btn-close btn-close-danger" aria-label="Dismiss">
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

        <div wire:ignore.self id="modalVista" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="VerVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="VerVestimenta"><b>Ver vestimenta</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
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
                                        <span class="badge text-bg-danger">Mujer</span>@else<span class="badge text-bg-primary">Hombre</span>
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
                                            <span class="badge text-bg-secondary fs-8">{{ $list }}</span>
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

        <div wire:ignore.self id="modalEliminar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ElimiarVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="VerVestimenta"><b>Eliminar vestimenta</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Seguro que quiere eliminar esta vestimenta?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="delete">Eliminar</button>
                        <button type="button" class="btn btn-secundary" wire:click="close">Cancelar</button>

                    </div>
                </div>
            </div>
        </div>


        {{-- model edit --}}

        <div wire:ignore.self id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="editVestimenta"><b>Editar vestimenta</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <h2>Nombre</h2>
                                        <input type="text" wire:model="nombre" for="nombre">
                                        @error('nombre')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <h2>Genero</h2>
                                        <select wire:model="genero">
                                            <option value="">Seleccione un genero</option>
                                            <option value="1">Hombre</option>
                                            <option value="0">mujer</option>
                                        </select>
                                        @error('genero')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                            <option value="">Seleccione una medida</option>
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
                                                    <button type="button" wire:click="EliminarLista({{ $list->id }})" class="close btn-close btn-close-danger" aria-label="Dismiss">
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
                        <button type="button" class="btn btn-primary" wire:click="update"> Guardar</button>
                    </div>
                </div>
            </div>
        </div>



        {{-- modales de medida --}}

        <div wire:ignore.self id="modalMedida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarMedida" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="agregarMedida"><b>Agregar medida</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="closeMedida"></button>
                    </div>

                    <div class="modal-body">

                        {{-- @if (in_array('medida.crear', $permisosMedida)) --}}
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMedidaAdd">Nueva
                            medida</button>
                        {{-- @endif --}}
                        <br>
                        <p>Lista de medidas</p>

                        <div class="d-flex flex-wrap ">
                            @foreach ($listMedidas as $list)
                            <div class="p-1">
                                <span class="badge badge-secundary">
                                    {{ $list->nombre }}
                                    {{-- @if (in_array('medida.eliminar', $permisosMedida)) --}}
                                    <button data-bs-toggle="modal" data-bs-target="#modalDeleteMedida" wire:click="loadData({{ $list->id }})" class="close btn-close btn-close-danger" aria-label="Dismiss">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{-- @endif --}}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="closeMedida"> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- medida delete --}}

        <div wire:ignore.self id="modalDeleteMedida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalMedidaEliminar" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalMedidaEliminar"><b>Eliminar medida</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="closeMedida"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Quiere eliminar la Medida "<b class="text-danger">{{$medidaNombre}}</b>". No se podra
                            recurperar</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" wire:click="deleteMedida">Eliminar</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeMedida">Cancelar</button>

                    </div>
                </div>
            </div>
        </div>

        {{-- medida add --}}
        <div wire:ignore.self id="modalMedidaAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarMedida" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="agregarMedida"><b>Agregar medida</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="closeMedida"></button>
                    </div>

                    <div class="modal-body">

                        <label>Nombre</label><br>
                        <input type="text" wire:model.lazy="medidaNombre">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" wire:click="storeMedida">Guardar</button>
                            <button type="button" class="btn btn-danger" wire:click="closeMedida"> Cancelar</button>
                        </div>
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
        window.addEventListener('cerrar-modal-eliminar', event => {
            $('#modalEliminar').modal('hide');
        });

        window.addEventListener('cerrar-modal-medida-vista', event => {
            $('#modalMedida').modal('hide');
        });
        window.addEventListener('cerrar-modal-medida-crear', event => {
            $('#modalMedidaAdd').modal('hide');
        });
        window.addEventListener('cerrar-modal-medida-eliminar', event => {
            $('#modalDeleteMedida').modal('hide');
        });
    </script>
    @endpush