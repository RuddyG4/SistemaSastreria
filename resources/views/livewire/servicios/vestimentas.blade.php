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
                            <h2 class="font-bold">10</h2>
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
                            <h2 class="font-bold">20</h2>
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
                            <h2 class="font-bold">260</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Widgets -->
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Agregar Vestimenta</h5>
            </div>
            <div class="ibox-content">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar vestimenta</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMedida">Agregar Medida</button>
            </div>
        </div>

        <div class="ibox ">
            <div class="ibox-title">
                <h5>Lista Vestimentas</h5>
            </div>

            <div class="ibox-content">
                <input type="text" class="form-control form-control-sm m-b-xs" id="filter" placeholder="Buscar Vestimenta">

                <table class="footable table table-stripped default footable-loaded" data-page-size="8" data-filter="#filter">
                    <thead>
                        <tr>
                            <th class="footable-visible footable-first-column footable-sortable">Id<span class="footable-sort-indicator"></span></th>
                            <th class="footable-visible footable-sortable">Nombre<span class="footable-sort-indicator"></span></th>
                            <th data-hide="phone,tablet" class="footable-visible footable-sortable">
                                Genero<span class="footable-sort-indicator"></span></th>
                            <th data-hide="phone,tablet" class="footable-visible footable-last-column footable-sortable">
                                Acciones<span class="footable-sort-indicator"></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX footable-even" style="">
                            <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>1</td>
                            <td class="footable-visible">Saco Mujer
                            </td>
                            <td class="footable-visible">
                                <span class="badge badge-danger">Femenino</span>
                            </td>
                            <td class="footable-visible footable-last-column">
                                <button class="btn btn-primary btn-xs">Ver </button>
                                <button class="btn btn-warning btn-xs">Editar </button>
                                <button class="btn btn-danger btn-xs">Eliminar </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="footable-visible">
                                <ul class="pagination float-right">
                                    <li class="footable-page-arrow disabled"><a data-page="first" href="#first">«</a>
                                    </li>
                                    <li class="footable-page-arrow disabled"><a data-page="prev" href="#prev">‹</a></li>
                                    <li class="footable-page active"><a data-page="0" href="#">1</a>
                                    </li>
                                    <li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li>
                                    <li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li>
                                </ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Disenio anterior
        <h1>Vista de vestimentas</h1>
        <h2>Agregar nueva vestimenta</h2>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar vestimenta</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMedida">Agregar Medida</button>

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
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalVista" wire:click="loadView({{ $list->id }})">Ver</button>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit" wire:click="edit({{ $list->id }})">Editar</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar" wire:click="loadView({{ $list->id }})">Eliminar</button>
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
-->
        {{-- modal add --}}
        <div wire:ignore.self id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarVestimenta" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarVestimenta">Agregar vestimenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="close"></button>
                    </div>
                    <div class="modal-body">
                        <form form wire:submit.prevent="store" id="form-id">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h2>Nombre</h2>
                                            <input type="text" wire:model.lazy="nombre">
                                            @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <h2>Genero</h2>
                                            <select wire:model.lazy="genero">
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
                        <h5 class="modal-title" id="VerVestimenta">Ver vestimenta</h5>
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
                        <h5 class="modal-title" id="VerVestimenta">Eliminar vestimenta</h5>
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
                        <h5 class="modal-title" id="editVestimenta">Editar vestimenta</h5>
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
                        <h5 class="modal-title" id="agregarMedida">Agregar medida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="closeMedida"></button>
                    </div>

                    <div class="modal-body">


                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMedidaAdd">Nueva medida</button>
                        <br>
                        <p>Lista de medidas</p>

                        <div class="d-flex flex-wrap ">
                            @foreach ($listMedidas as $list)
                            <div class="p-1">
                                <span class="badge badge-secundary">
                                    {{ $list->nombre }}
                                    <button data-bs-toggle="modal" data-bs-target="#modalDeleteMedida" wire:click="loadData({{ $list->id }})" class="close btn-close btn-close-danger" aria-label="Dismiss">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="form-idppppp" class="btn btn-primary">Guardar</button>
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
                        <h5 class="modal-title" id="modalMedidaEliminar">Eliminar medida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="closeMedida"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Quiere eliminar la Medida "<b class="text-danger">{{$medidaNombre}}</b>". No se podra recurperar</h4>
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
                        <h5 class="modal-title" id="agregarMedida">Agregar medida</h5>
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