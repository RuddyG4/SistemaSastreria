<div>
    <x-slot:title>
        Asignacion de vestimentas
    </x-slot:title>
    <?php
    $vestimentasSinAsignar = $pedido->detalles_sum_cantidad - $pedido->vestimentas_count;
    ?>
    @if ($vestimentasSinAsignar > 0)
    <div class="panel panel-default my-2 px-2 py-2">
        <div class="row">
            <div class="col">
                <span class="fs-6"><strong class="text-warning">Vestimentas sin asignar :</strong> <b>{{ $vestimentasSinAsignar }}</b></span>
            </div>
            <div class="col text-right">
                <button type="button" data-bs-toggle="modal" data-bs-target="#asignarVestimentas" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Asignar vestimentas</a>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal para asignar vestimentas -->
    <div wire:ignore.self id="asignarVestimentas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Asignacion de Vestimentas</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col">
                            <div>
                                <strong class="fs-6">Vestimentas sin asignar :</strong>
                                <span>{{ $pedido->detalles->sum('cantidad') - $vestimentas->sum('unidades_vestimenta_count') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for=""><strong>Seleccione un cliente</strong></label>
                            <select wire:model="id_cliente" class="form-control">
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{$cliente->persona->nombre }} {{$cliente->persona->apellido }}</option>
                                @endforeach
                            </select>
                            @error('id_cliente')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <label><strong>Seleccione una vestimenta:</strong></label>
                            <select wire:model="id_vestimenta" class="form-control">
                                <option value="">Seleccione uno</option>
                                @foreach($vestimentas as $vestimenta)
                                @if($vestimenta->unidades_vestimenta_count < $vestimenta->detalles->sum('cantidad'))
                                    <option value="{{ $vestimenta->id }} ">{{ $vestimenta->nombre }}</option>
                                    @endif
                                    @endforeach
                            </select>
                            @error('id_vestimenta')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <label for=""><strong>cantidad</strong></label>
                            <input type="number" wire:model="cantidad" class="form-control">
                            @error('cantidad')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-auto">
                            <button class="btn btn-primary btn-outline dim" wire:click="asignarVestimenta" type="button"><i class="fa fa-plus"></i></button>
                        </div>

                        <!-- Asignar medidas de las vestimentas -->
                        <!-- <div class="panel panel-pad panel-default">
                            <div class="row">
                                <div class="col">
                                    <h3 class="fs-6">Ingrese las medidas</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for=""><strong>Medida :</strong></label>
                                    <input type="number" wire:model="">
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>