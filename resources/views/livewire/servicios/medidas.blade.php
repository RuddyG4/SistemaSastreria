<x-slot:title>
    Medidas
</x-slot>

<div>
    
    {{-- agregar --}}
    <h2>Agregar nueva medida</h2>

    <form form wire:submit.prevent="store" id="form-id">

        <div class="input-group mb-3">
            <input wire:model="nombre" placeholder="Agregar medida" type="text" class="form-control">
            <button type="submit" form="form-id" class="btn btn-primary" @if (empty($nombre))disabled @endif>Guardar</button>
        </div>
    </form>

    {{-- busqueda --}}
    <h2>Lista de medidas</h2>
        <div class="row">
            <div class="col">
                <input wire:model="busqueda" class="form-control col-md-6" type="text" placeholder="Buscar...">
            </div>
        </div>
        <br>
    {{-- tabla --}}

    <div class="ibox-content">
       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listMedidas as $list)
                       
                <tr>
                    <td>
                    @if ($list->id == $id_medida)
                        <input type="text" class="form-control" wire:model="nombreEdit">
                    @error('nombreEdit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @else
                        {{ $list->nombre }}
                    @endif
                    </td>
                    
                    <td>
                        @if ($list->id == $id_medida)
                            <div>
                                <button class="btn btn-success" wire:click="update">Guardar</button>
                                <button class="btn btn-secondary" wire:click="close">Cancelar</button>
                            </div>
                        @else
                            <button class="btn btn-primary" wire:click="edit({{ $list->id }})">Editar</button>
                            <button class="btn btn-danger" wire:click="delete({{ $list->id }})">Eliminar</button>
                        @endif
                    </td>

                </tr>
                
                @endforeach
            </tbody>
        </table>
       


        @if( $listMedidas->hasPages() )
            <div class="px-6 py-3">
                {{ $listMedidas->links() }}
            </div>
        @endif
    </div>


</div>




