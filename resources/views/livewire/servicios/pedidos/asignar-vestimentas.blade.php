<div>
    <x-slot:title>
        Asignacion de vestimentas
    </x-slot:title>
    <div class="ibox">
        <div class="ibox-title mb-2">
            <h2><b><strong>Asignacion de vestimentas</strong></b></h2>
        </div>

        <div class="ibox-content">
            <div class="row mb-2">
                <div class="col">
                    <div>
                        <strong class="fs-6">Vestimentas sin asignar :</strong>
                        <span>{{ $pedido->detalles->sum('cantidad') - $vestimentas->sum('unidades_vestimenta_count') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for=""><strong>Seleccione un cliente</strong></label>
                    <select name="" id="" wire:model="id_cliente" class="form-control">
                        @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{$cliente->persona->nombre }} {{$cliente->persona->apellido }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label ><strong>Seleccione una vestimenta:</strong></label>
                    <select name="" id="" class="form-control">
                        @foreach($vestimentas as $vestimenta)
                        @if($vestimenta->unidades_vestimenta_count < $vestimenta->detalles->sum('cantidad'))
                        <option value="{{ $vestimenta->id }} ">{{ $vestimenta->nombre }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for=""><strong>cantidad</strong></label>
                    <input type="number" name="" id="" class="form-control">
                </div>
                <div class="col-auto pt-3">
                    <button class="btn btn-primary btn-outline dim" type="button"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>
    
</div>
