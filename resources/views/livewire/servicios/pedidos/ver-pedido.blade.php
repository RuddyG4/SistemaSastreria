<x-app>
    <x-slot:title>
        Ver pedido
    </x-slot:title>
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
                                    <!-- <div class="col-lg-6 text-right">
                                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar pedido</a>
                                    </div> -->
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

                        <!-- Vestimentas sin asignar -->
                        <livewire:servicios.pedidos.asignar-vestimentas :pedido="$pedido" />

                        <!-- inicio  tabs-->
                        <livewire:servicios.pedidos.vestimenta-pedido :pedido="$pedido" />
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

        @push('scripts')

        @endpush
</x-app>