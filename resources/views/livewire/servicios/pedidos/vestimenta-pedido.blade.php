<div class="ibox-content">
    <ul class="nav nav-tabs">
        <li>
            <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"><i class="fa fa-scissors fa-2x"></i> Vestimentas</a>
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
                            <th>Propietario de vestimentas</th>
                            <th>Total vestimentas</th>
                            <th>Vestimentas terminadas</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($propietarios as $propietario)
                        <tr>
                            <td>
                                {{ $propietario->nombre }} {{ $propietario->apellido }}
                            </td>
                            <td>
                                {{ $propietario->unidades_vestimenta_count }} unidades
                            </td>
                            <td>
                                {{ $propietario->vestimentas_terminadas_count }} unidades
                            </td>
                            <td>
                                <button wire:click="verVestimentas( {{ $propietario->id }} )" data-bs-toggle="modal" data-bs-target="#vestimentas" class="btn btn-secondary btn-sm" type="button">
                                    <i class="fa fa-info-circle"></i>&nbsp;&nbsp; Ver vestimentas
                                </button>
                            </td>
                        </tr>
                        @endforeach
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
                            <div @class([ 'vertical-timeline-icon' , 'blue-bg'=> ($fecha_pago->estado == 0),
                                'navy-bg' => ($fecha_pago->estado == 1 )])>
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <div class="vertical-timeline-content">
                                <h2><strong>Pago {{ $loop->index + 1 }}</strong></h2>
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
                                        <dd class="mb-1">
                                            @if($fecha_pago->estado == 0)
                                            <span class="label label-success">Sin pagar</span>
                                            @else
                                            <span class="label label-primary">Pagado</span>
                                            @endif
                                        </dd>
                                    </div>
                                </dl>
                                <span class="vertical-date">
                                    <strong>Fecha de Pago </strong>
                                    <br />
                                    <small>{{ $fecha_pago->fecha }}</small>
                                </span>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self id="vestimentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Vestimentas de <strong>Nombre</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    @foreach($vestimentas as $vestimenta)
                    <div class="row">
                        <div class="col">
                            <div class="ibox-title">
                                <h5>titulo</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <dl class="row mb-0">
                                            <div class="col-sm-4 text-right">
                                                <dt>Medida</dt>
                                            </div>
                                            <div class="col-sm-8 text-sm-left">
                                                <dd class="mb-1"> 10cm</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Basic Table</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#" class="dropdown-item">Config option 1</a>
                                            </li>
                                            <li><a href="#" class="dropdown-item">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelar"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>