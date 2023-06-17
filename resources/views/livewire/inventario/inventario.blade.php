<x-slot:title>
    Inventario
    </x-slot>
    <div>
        <h1><b>Inventario</b></h1>

        @if(isset($almacenes))

        <div class="row">
            <div class="form-group col-auto">
                <select wire:model="almacen" id="rol" class="form-control">
                    @foreach($almacenes as $almacen)
                    <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <input wire:model="busqueda" class="form-control col-md-6" type="text" placeholder="Buscar...">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarMaterial">Agregar materiales</button>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalSacarMaterial">Sacar materiales</button>
            </div>
        </div>


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

        <!-- Modales -->

        <!-- Modal de agregar materiales -->
        <div wire:ignore.self id="modalAgregarMaterial" class="modal fade" tabindex="-1" aria-labelledby="agregarMaterial" aria-hidden="true" data-bs-keyboard="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="agregarMaterial">Crear Nota de ingreso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">

                        <h4>Agregados</h4>
                        @if(!$detalles->isEmpty())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID Material</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalles as $index => $detalle)
                                <tr>
                                    <td><input type="text" class="form-control col-md-4" wire:model="detalles.{{$index}}.id_material" value="hola" id=""></td>
                                    <td><input type="text" class="form-control col-md-3" wire:model="detalles.{{$index}}.cantidad" id=""></td>
                                    <td><input type="text" class="form-control col-md-3" wire:model="detalles.{{$index}}.precio" id=""></td>
                                    <td>
                                        <button wire:click="quitarMaterialIngreso({{$index}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-warning">
                        <p style="display: flex; justify-content: center;">No se han agregado materiales!!</p>
                        </div>
                        @endif
                        <h4>Agregar</h4>
                        <form wire:submit.prevent="guardarNotaIngreso" id="form-id">
                            @csrf

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="id_material">Material</label>
                                    <select wire:model="id_material" id="rol" class="form-control">
                                        <option value="">Seleccione uno</option>
                                        @foreach($materiales as $material)
                                        <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_material')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                                    @error('cantidad')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="precio">Precio</label>
                                    <input type="number" id="precio" class="form-control" wire:model.lazy="precio">
                                    @error('precio')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <br>
                                    <button wire:click="adicionarMaterialIngreso" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                        <button type="submit" form="form-id" class="btn btn-primary">Crear nota de ingreso</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('cerrar-modal', event => {
            $('#modalAgregarMaterial').modal('hide');
        });
        window.addEventListener('cerrar-modal-edicion', event => {
            $('#modalSacarMaterial').modal('hide');
        });
    </script>

    <script>
        Livewire.on('confirmarBaja', id => {
            Swal.fire({
                title: '¿Está seguro?',
                text: "El usuario seleccionado ya no podrá acceder al sistema",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EC4758',
                cancelButtonColor: '#808991',
                confirmButtonText: 'Sí, dar de baja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('usuarios.usuarios', 'darBaja', id);
                    Swal.fire(
                        'Usuario inactivo!',
                        'El usuario seleccionado ha sido dado de baja.',
                        'success'
                    )
                }
            })
        })

        Livewire.on('usuarioActualizado', function() {
            Swal.fire(
                'Usuario actualizado!',
                'Los cambios se guardaron correctamente!',
                'success'
            )
        })

        Livewire.on('notaIngresoCreada', function() {
            Swal.fire(
                'Nota de Ingreso agregada!',
                'La Nota de Ingreso ha sido agregada correctamente!',
                'success'
            )
        })
    </script>
    @endpush