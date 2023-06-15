<x-slot:title>
    Inventario
    </x-slot>
    <div>
        <h1><b>Inventario</b></h1>

        @if(isset($almacenes))
        <label for="almacen">Almacen seleccionado: </label>
        <select wire:model="almacen" id="rol">
            @foreach($almacenes as $almacen)
            <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
            @endforeach
        </select>
        <input wire:model="busqueda" type="text" placeholder="Buscar...">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarMaterial">Agregar materiales</button>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalSacarMaterial">Sacar materiales</button>

        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Material</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $dato)
                    <tr>
                        <td>{{ $dato->material->nombre }}</td>
                        <td>{{ $dato->cantidad }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No existen almacenes.</p>
        @endif
    </div>

    <!-- Modales -->

    <!-- Modal de agregar materiales -->
    <div wire:ignore.self id="modalAgregarMaterial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="agregarMaterial" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarMaterial">Crear Nota de ingreso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <h6>Agrege los productos</h6>
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf

                        <label for="id_material">Material</label>
                        <select wire:model="id_material" id="rol">
                            <option value="">Seleccione un material</option>
                            @foreach($materiales as $material)
                            <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>

                        <label for="cantidad">Cantidad</label>
                        <input type="number" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                        @error('cantidad')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="precio">Precio</label>
                        <input type="number" id="precio" class="form-control" wire:model.lazy="precio">
                        @error('precio')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Crear nota de ingreso</button>
                </div>
            </div>
        </div>
    </div>