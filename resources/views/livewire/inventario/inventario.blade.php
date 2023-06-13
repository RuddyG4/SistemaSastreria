<x-slot:title>
    Inventario
    </x-slot>
<div>
    <h1><b>Inventario</b></h1>
    <input wire:model="busqueda" type="text" placeholder="Buscar...">

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Añadir cliente</button>

    <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Almacen</th>
                        <th scope="col">Material</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $dato)
                    <tr>
                        <td>{{ $dato->almacen->nombre }}</td>
                        <td>{{ $dato->material->nombre }}</td>
                        <td>{{ $dato->cantidad }}</td>
                        <td>
                            @if(in_array('cliente.modificar', $permisos))
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDeEdicion" wire:click="editar({{ $cliente->id }})">Editar</button>
                            @endif
                            @if(in_array('cliente.eliminar', $permisos))
                            <button class="btn btn-danger" wire:click="$emit('confirmarEliminacion', {{ $cliente->id}} )">Eliminar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
