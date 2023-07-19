<div>
    <div class="row">
        <!-- INICIO FILTROS -->
        <div class="col">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Agregar Filtros</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre_cliente">Cliente</label>
                                <input id="nombre_cliente" placeholder="Nombre Cliente" wire:model.defer="nombre" max="40" class="form-control">
                            </div>
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fecha_desde" class="font-normal">Desde fecha de Recepcion</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input id="fecha_desde" type="date" class="form-control custom-date-input" value="" wire:model.defer="fechaDesde">
                                </div>
                            </div>
                            @error('fechaDesde')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fecha_hasta" class="font-normal">Hasta fecha de Recepcion</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input id="fecha_hasta" type="date" class="form-control custom-date-input" max="{{ now()->toDateString() }}" wire:model.defer="fechaHasta">
                                </div>
                            </div>
                            @error('fechaHasta')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <div class="form-group">
                                <label class="font-normal"></label>
                                <div class="input-group date">
                                    <button wire:click="aplicarFiltros" class="btn btn-primary">Aplicar filtros</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-group">
                                <label class="font-normal"></label>
                                <div class="input-group date">
                                    <button wire:click="reiniciarPropiedades" class="btn btn-secondary btn-outline dim"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-9">
                <h3>Lista de Pedidos</h3>
            </div>
            <div class="col-sm-3 d-flex align-items-end justify-content-end">
                <a href="{{ url('/dashboard/adm_servicios/pedidos/crear') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Crear Nuevo</span>
                </a>
            </div>
        </div>
        <div class="hr-line-dashed"></div>

        <!-- INICIO TABLA PRINCIPAL -->
        <table class="footable table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Telefono</th>
                    <th>Descripcion</th>
                    <th>Estado avance</th>
                    <th>Fecha Recepcion</th>
                    <th>Tipo pedido</th>
                    <th>
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->nombre_cliente }} {{ $pedido->apellido_cliente }}</td>
                    <td>{{ $pedido->telefono }}</td>
                    <td>{{ $pedido->descripcion }}</td>
                    <td>
                        <?php
                        $pedidoSinAvance = $pedido->estado_avance == 0;
                        $pedidoCompletado = ($pedido->estado_avance == 1);
                        $pedidoEnProceso = !$pedidoSinAvance && !$pedidoCompletado;
                        ?>
                        <span @class([ 'label' , 'label-secondary'=> $pedidoSinAvance,
                            'label-primary'=> $pedidoCompletado,
                            'label-success'=> $pedidoEnProceso,
                            ])>
                            {{ $pedido->estado_avance * 100 }} %
                        </span>
                    </td>
                    <td>{{ $pedido->fecha_recepcion }}</td>
                    <td>
                        @if($pedido->tipo == 0)
                        <i class="fa fa-user"></i> Personal
                        @else
                        <i class="fa fa-users"></i> Grupal
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a href="{{ url('/dashboard/adm_servicios/pedidos/'.$pedido->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i> Detalles</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            @if( $pedidos->hasPages() )
            <tfoot>
                <tr>
                    <td colspan="6">
                        {{ $pedidos->links() }}
                    </td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
    <!-- FIN TABLA PRINCIPAL -->
</div>