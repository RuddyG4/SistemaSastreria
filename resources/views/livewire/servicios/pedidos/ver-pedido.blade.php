<x-app>
    <x-slot:title>
        Ver pedido
        </x-slot>
        <!-- Código aquí -->
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2><strong>Contrato con {{ $pedido->nombre_cliente }} {{ $pedido->apellido_cliente }}</strong></h2>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Editar pedido</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-right">
                                            <dt>Estado:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <?php
                                            $pedidoSinAvance = $pedido->estado_avance == 0;
                                            $pedidoCompletado = ($pedido->estado_avance == 1);
                                            $pedidoEnProceso = !$pedidoSinAvance && !$pedidoCompletado;
                                            ?>
                                            <dd class="mb-1">
                                                <span @class([ 'label' , 'label-secondary'=> $pedidoSinAvance,
                                                    'label-primary'=> $pedidoCompletado,
                                                    'label-success'=> $pedidoEnProceso,
                                                    ])>
                                                    @if($pedidoSinAvance)
                                                    Sin avance
                                                    @elseif ($pedidoEnProceso)
                                                    En proceso
                                                    @else
                                                    Completado
                                                    @endif
                                                </span>
                                            </dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-right">
                                            <dt>Creado por:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">{{ $pedido->usuario }}</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-right">
                                            <dt>Vestimentas:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"> {{ $pedido->detalles_sum_cantidad }}</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-right">
                                            <dt>Cant. Clientes:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">10 personas </dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4 text-right">
                                            <dt>Tipo de pedido:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">
                                                @if($pedido->tipo == 0)
                                                <i class="fa fa-user"></i> Personal
                                                @else
                                                <i class="fa fa-users"></i> Grupal
                                                @endif
                                            </dd>
                                        </div>
                                    </dl>

                                </div>
                                <div class="col" id="cluster_info">

                                    <dl class="row mb-0">
                                        <div class="col-sm-6 text-right">
                                            <dt>Última Actualización:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"><i class="fa fa-calendar"></i> 12/07/23 12:40:14</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-6 text-right">
                                            <dt>Creado:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"><i class="fa fa-calendar"></i> {{ $pedido->fecha_recepcion }}</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-6 text-right">
                                            <dt>Descripcion:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"> {{ $pedido->descripcion }}</dd>
                                        </div>
                                    </dl>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="row mb-0">
                                        <div class="col-sm-2 text-right">
                                            <dt>Completado:</dt>
                                        </div>
                                        <div class="col-sm-10 text-sm-left">
                                            <dd>
                                                <div class="progress m-b-1">
                                                    <div style="width: {{ $pedido->estado_avance * 100 }}%;" @class([ 'progress-bar' , 'progress-bar-striped' , 'progress-bar-secondary'=> $pedidoSinAvance,
                                                        'progress-bar-primary'=> $pedidoCompletado,
                                                        'progress-bar-success'=> $pedidoEnProceso,
                                                        ])></div>
                                                </div>
                                                <small>Pedido finalizado en un <strong>{{ $pedido->estado_avance * 100 }} %</strong>.</small>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <!-- inicio  tabs-->
                            <div class="ibox-content">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"><i class="fa fa-scissors fa-2x"></i> Detalles de vestimentas</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><i class="fa fa-calendar fa-2x"></i> Fechas de pago</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Cant. Vestimentas</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            Jorge
                                                        </td>
                                                        <td>
                                                            5 Unidades
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal" data-bs-target="#Detalle" class="btn btn-danger btn-xs"><i class="fa fa-info-circle"></i> Detalle Vestimenta</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            camila
                                                        </td>
                                                        <td>
                                                            6 Unidades
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal" data-bs-target="#Detalle" class="btn btn-danger btn-xs"><i class="fa fa-info-circle"></i> Detalle Vestimenta</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-pane">
                                        <div class="table-responsive">
                                            <div class="ibox-content" id="ibox-content">
                                                <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">
                                                    @foreach ($pedido->fechasPago as $fecha_pago)
                                                    <div class="vertical-timeline-block">
                                                        <div class="vertical-timeline-icon navy-bg">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </div>
                                                        <div class="vertical-timeline-content">
                                                            <h2>Pago {{ $loop->index + 1 }}</h2>
                                                            <p>{{ $fecha_pago->descripcion }}</p>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4">
                                                                    <dt>Monto:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-right">
                                                                    <dd class="mb-1"><span>{{ $fecha_pago->monto }}</span></dd>
                                                                </div>
                                                            </dl>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4">
                                                                    <dt>Estado:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-right">
                                                                    <dd class="mb-1"><span class="label label-primary">Cancelado</span></dd>
                                                                </div>
                                                            </dl>
                                                            <span class="vertical-date">
                                                                Fecha de Pago <br />
                                                                <small>{{ $fecha_pago->fecha }}</small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    <div class="vertical-timeline-block">
                                                        <div class="vertical-timeline-icon blue-bg">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </div>

                                                        <div class="vertical-timeline-content">
                                                            <h2>x- pago</h2>
                                                            <p>x- pago con el monto de pago de XX</p>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4">
                                                                    <dt>Estado:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-right">
                                                                    <dd class="mb-1"><span class="label label-warning">Pendiente</span></dd>
                                                                </div>
                                                            </dl>
                                                            <span class="vertical-date">
                                                                Fecha de Pago <br />
                                                                <small>2023-09-07</small>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="vertical-timeline-block">
                                                        <div class="vertical-timeline-icon lazur-bg">
                                                            <i class="fa fa-calendar-o"></i>
                                                        </div>

                                                        <div class="vertical-timeline-content">
                                                            <h2>x- pago</h2>
                                                            <p>x- pago con el monto de pago de XX</p>
                                                            <dl class="row mb-0">
                                                                <div class="col-sm-4">
                                                                    <dt>Estado:</dt>
                                                                </div>
                                                                <div class="col-sm-8 text-right">
                                                                    <dd class="mb-1"><span class="label label-warning">Pendiente</span></dd>
                                                                </div>
                                                            </dl>
                                                            <span class="vertical-date">
                                                                Fecha de Pago <br />
                                                                <small>2023-12-07</small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <div class="contact-box center-version p-4">
                        <div class="text-center">
                            <i class="fa fa-user-circle-o" style="font-size: 10em;"></i>
                        </div>
                        <h3 class="m-b-md text-center mt-3"><strong><i class="fa fa-address-book-o"></i> {{ $pedido->nombre_cliente }} {{ $pedido->apellido_cliente }} </strong></h3>
                        <hr>
                        <div class="text-center">
                            <h4><i class="fa fa-phone"></i> {{ $pedido->numero_cliente }}</h4>
                            <h4><i class="fa fa-address-card-o"></i> {{ $pedido->ci_cliente }}</h4>
                            <h4><i class="fa fa-map-marker"></i> {{ $pedido->direccion_cliente }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL 1 -->
            <div wire:ignore.self id="Detalle" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Detalles Vestimenta</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-lg-12">
                                <div class="ibox panel panel-success">
                                    <div class="ibox collapsed mb-1">
                                        <div class="ibox-title collapse-link">
                                            <h5>Pantalon</h5><i class="fa fa-chevron-up pull-right"></i>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Brazos:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> 130 cm</dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Pecho:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">100 cm </dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Cintura:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">
                                                                160 cm
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-6">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Hombro:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> 130 cm</dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Pie:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">100 cm </dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Manga:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">
                                                                160 cm
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="ibox panel panel-success">
                                    <div class="ibox collapsed mb-1">
                                        <div class="ibox-title collapse-link" style="cursor: pointer;">
                                            <h5>Chaleco</h5><i class="fa fa-chevron-up pull-right"></i>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Brazos:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> 130 cm</dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Pecho:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">100 cm </dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Cintura:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">
                                                                160 cm
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                                <div class="col-lg-6">
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Hombro:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1"> 130 cm</dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Pie:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">100 cm </dd>
                                                        </div>
                                                    </dl>
                                                    <dl class="row mb-0">
                                                        <div class="col-sm-4 text-right">
                                                            <dt>Manga:</dt>
                                                        </div>
                                                        <div class="col-sm-8 text-sm-left">
                                                            <dd class="mb-1">
                                                                160 cm
                                                            </dd>
                                                        </div>
                                                    </dl>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelar"> Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')

            @endpush
</x-app>