<div>
    {{-- Panel de pasos --}}
    <div class="ibox-title">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-circle {{ $step != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                    <p>Datos principales</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-circle {{ $step != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                    <p>Seleccionar vestimentas</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-circle {{ $step != 3 ? 'btn-default' : 'btn-primary' }}">3</a>
                    <p>Información de pago</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-circle {{ $step != 4 ? 'btn-default' : 'btn-primary' }}">4</a>
                    <p>Confirmación</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Formulario --}}
    <form wire:submit.prevent="crearPedido" id="form">
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">

                    <div class="row">
                        {{-- Paso 1 --}}
                        <div class="col-7 {{ $step === 1 ? '':'dontShow' }}">
                            <fieldset>
                                <h4>Descripcion de Pedido</h4>
                                <div class="form-group" class="">
                                    <textarea class="form-control" rows="3" wire:model.debounce.800ms="pedido.descripcion"></textarea>
                                    @error('pedido.descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h4>Cliente encargado :</h4>
                                    <div>
                                        <input type="number" class="form-control" id="busqueda" wire:model="busqueda" placeholder="Buscar por CI...">
                                        @error('pedido.id_cliente')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        @if ($busqueda)
                                        <div>
                                            <ul class="todo-list small-list">
                                                @foreach ($clientes as $cliente)
                                                <li class="p-0">
                                                    <button class="btn col-lg-12 text-start" type="button" wire:click="seleccionarCliente( {{ $cliente->id }} )">{{
                                                        $cliente->nombre }} {{ $cliente->apellido }}</button>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    @if ($pedido->id_cliente)
                                    <?php
                                    $persona = $pedido->cliente->persona
                                    ?>
                                    <i class="fa fa-user fa-5x text-navy"></i>
                                    <div>
                                        <span><strong>Nombre: </strong></span>{{ $persona->nombre }} {{
                                        $persona->apellido }}
                                        <br>
                                        <span><strong>CI: </strong></span> {{ $persona->ci }}
                                    </div>
                                    @else
                                    <i class="fa fa-user fa-5x"></i>
                                    @endif
                                </div>

                                <div class="form-group" class="col-sm-10">
                                    <h4>Tipo de Pedido</h4>
                                    <div class="radio radio-info">
                                        <input type="radio" id="inlineRadio1" wire:model="pedido.tipo" value="0" name="radioInline" />
                                        <label for="inlineRadio1">
                                            PERSONAL <i class="fa fa-user"></i> &nbsp;&nbsp;
                                        </label>
                                        <input type="radio" id="inlineRadio2" wire:model="pedido.tipo" value="1" name="radioInline" />
                                        <label for="inlineRadio2">
                                            GRUPAL <i class="fa fa-users"></i>
                                        </label>
                                    </div>
                                    @error('pedido.tipo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                            </fieldset>
                        </div>

                        {{-- PASO 2: Detalles de pedido --}}
                        <div class="col {{ $step === 2 ? '':'dontShow' }}">
                            <fieldset>
                                <h3>Agregar vestimentas</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="id_material">Material</label>
                                        <select wire:model="id_vestimenta" id="id_material" class="form-control">
                                            <option value="">Seleccione uno</option>
                                            @foreach($vestimentas as $vestimenta)
                                            <option value="{{ $vestimenta->id }}">{{ $vestimenta->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_vestimenta')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" min="1" step="1" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                                        @error('cantidad')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <br>
                                        <button wire:click="adicionarDetallePedido" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Agregados</h4>
                                        @if(!$detalles->isEmpty())
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Material</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Precio</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detalles as $index => $detalle)
                                                <tr>
                                                    <td>
                                                        <input readonly type="text" class="form-control col-md-4" value="{{ $detalle->vestimenta->nombre }} " id="">
                                                    </td>
                                                    <td>
                                                        <input readonly type="text" class="form-control col-md-3" wire:model="detalles.{{$index}}.cantidad" id="">
                                                    </td>
                                                    <td>
                                                        <button wire:click="quitarDetallePedido({{$index}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else

                                        @if (session()->has('message'))
                                        <div class="alert alert-danger">
                                            <p style="display: flex; justify-content: center;">No se agregaron
                                                vestimentas!!
                                            </p>
                                        </div>
                                        @else
                                        <div class="alert alert-warning">
                                            <p style="display: flex; justify-content: center;">No se agregaron
                                                vestimentas!!
                                            </p>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        {{-- PASO 3: Información de pago --}}
                        <div class="col {{ $step === 3 ? '':'dontShow' }}">
                            <fieldset>
                                <div class="row">
                                    <div class="col">
                                        <h3>Detalle de Pago</h3>
                                        <div class="form-group">
                                            <label>Pago inicial</label>
                                            <input type="number" wire:model="pagoInicial" class="form-control" />
                                            @error('pagoInicial')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <h4>Registrar fechas de pago próximas :</h4>
                                        <div class="row">
                                            <div class="col">
                                                <label for="id_material">Fecha de pago :</label>
                                                <input type="date" wire:model="fecha" min="{{ now()->toDateString() }}" class="form-control">
                                                @error('fecha')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col">
                                                <label for="monto">Monto</label>
                                                <input type="number" min="1" step="1" id="monto" class="form-control" wire:model.lazy="monto">
                                                @error('monto')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-auto">
                                                <br>
                                                <button wire:click="adicionarFechaPago" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col">
                                        <h3>Resumen de pago :</h3>
                                        <div class="form-group">
                                            <label>Saldo</label>
                                            <input type="number" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <h4>Fechas de pago registradas :</h4>
                                            @if ( !$pagoInicial == null)
                                            <table class="table table-striped" id="data_1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <i class="fa fa-calendar"></i> Fecha de Pago
                                                        </th>
                                                        <th>
                                                            <i class="fa fa-money"></i> Monto
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            {{ now()->toDateString() }} (Hoy)
                                                        </td>
                                                        <td>
                                                            {{ $pagoInicial }}
                                                        </td>
                                                    </tr>
                                                    @foreach ($fechas as $index => $fecha)
                                                    <tr>
                                                        <td>
                                                            {{ $fecha->fecha}}
                                                        </td>
                                                        <td>
                                                            {{ $fecha->monto }}
                                                        </td>
                                                        <td>
                                                            <button wire:click="quitarFechaPago({{$index}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @else
                                            @if (session()->has('message'))
                                            <div class="alert alert-danger">
                                                <p style="display: flex; justify-content: center;">No se agregaron
                                                    fechas de pago!!
                                                </p>
                                            </div>
                                            @else
                                            <div class="alert alert-warning">
                                                <p style="display: flex; justify-content: center;">No se agregaron
                                                    fechas de pago!!
                                                </p>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Total a Pagar</label>
                                            <input type="number" class="form-control" disabled />
                                        </div>


                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        {{-- PASO 4: Confirmar creación del pedido --}}
                        <div class="col {{ $step === 4 ? '':'dontShow' }}">
                            <fieldset>
                                <h3>Verificar Datos</h3>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h4>Datos del pedido:</h4>
                                        <div class="panel panel-success panel-pad">
                                            <div class="col-lg-10">
                                                @if ($pedido->id_cliente)
                                                <div class="form-group">
                                                    <strong><i class="fa fa-user-o"></i> Titular</strong>
                                                    <p>
                                                        {{ $persona->nombre }} {{ $persona->apellido }}
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <strong>C.I. Titular</strong>
                                                    <p>
                                                        {{ $persona->ci }}
                                                    </p>
                                                </div>
                                                <div class="form-group">
                                                    <strong>Tipo de Pedido</strong>
                                                    <p><i class="fa fa-user"></i> {{ $pedido->tipo ==
                                                        0?'Personal':'Grupal' }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <strong>Descripcion</strong>
                                                    <p>
                                                        {{ $pedido->descripcion}}
                                                    </p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <h4>Vestimentas seleccionadas</h4>
                                        <div class="panel panel-success panel-pad">
                                            @if(!$detalles->isEmpty())
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Material</th>
                                                        <th scope="col">Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($detalles as $index => $detalle)
                                                    <tr>
                                                        <td>
                                                            {{ $detalle->vestimenta->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $detalle->cantidad}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <h4>Fechas de Pagos</h4>
                                        <div class="panel panel-success panel-pad">
                                            <div class="col">
                                                <table class="table table-striped" id="data_1">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <i class="fa fa-calendar"></i> Fecha de Pago
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-money"></i> Monto
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                {{ now()->toDateString() }} (Hoy)
                                                            </td>
                                                            <td>
                                                                {{ $pagoInicial }}
                                                            </td>
                                                        </tr>
                                                        @foreach ($fechas as $index => $fecha)
                                                        <tr>
                                                            <td>
                                                                {{ $fecha->fecha}}
                                                            </td>
                                                            <td>
                                                                {{ $fecha->monto }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="ibox-footer text-right">
                            <button class="btn btn-secondary" type="button" wire:click="previousStep">Anterior</button>
                            @if ($step === 4)
                            <button type="submit" class="btn btn-primary">Crear pedido</button>
                            @else
                            <button class="btn btn-primary" type="button" wire:click="nextStep">Siguiente</button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </form>
</div>
@push('scripts')
<script>
    Livewire.on('pedidoCreado', function() {
        Swal.fire({
            title: 'Pedido creado!',
            text: "El Pedido ha sido registrado correctamente!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#48C842',
            confirmButtonText: 'Ver lista de pedidos',
            cancelButtonText: 'Crear otro pedido!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('servicios.pedidos.crear-pedido', 'irAPedidos');
            }
        })
    });
</script>
@endpush