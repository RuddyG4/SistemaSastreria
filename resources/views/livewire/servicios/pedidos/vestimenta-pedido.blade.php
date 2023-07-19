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

    <!-- Modal para ver las vestimentas -->
    <div wire:ignore.self id="vestimentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Vestimentas de <strong>Nombre</strong></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" ></button>
                </div>
                <div class="modal-body">
                    @foreach($vestimentas as $vestimenta)
                    <?php $terminado = $vestimenta->estado == 1 ?>
                    <div @class(['panel', 'panel-pad', 'panel-primary' => $terminado, 'panel-default' => !$terminado])>
                            <div class="row">
                                <div class="col">
                                    <h3 class="fs-6">{{ $vestimenta->vestimenta->nombre}}</h3>
                                </div>
                                @if(!$terminado)
                                <div class="col-auto text-right">
                                    <button class="btn btn-primary btn-sm" wire:click="marcarComoTerminado( {{ $vestimenta->id }} )" type="button">Marcar como terminado</button>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($medidas != null && $id_vestimenta == $vestimenta->id && $vestimenta->fecha_cambio == null)
                                @foreach($medidas as $i => $medida)
                                <label for=""><strong>{{ $medida->medida->nombre }} :</strong></label>
                                <input class="form-control" type="number" wire:model="medidas.{{ $i }}.valor">
                                @endforeach
                                <button class="btn btn-success btn-sm mt-2" wire:click="guardarMedidas( {{ $vestimenta->id_cliente }} )" type="button">Guardar Cambios</button>
                                @else
                                @foreach($vestimenta->medidasVestimenta as $medida)
                                <div class="col-lg-6">
                                    <label for=""><strong>{{ $medida->medida->nombre }} :</strong></label>
                                    <span>{{ $medida->valor }}</span>
                                </div>
                                @endforeach
                                @if($vestimenta->fecha_cambio == null && !$terminado)
                                <div class="col-lg-12 py-2">
                                    <button class="btn btn-success btn-sm" type="button" wire:click="cambiarMedidas( {{ $vestimenta->id }} )">Cambiar medidas</button>
                                </div>
                                @endif
                                @endif
                            </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>