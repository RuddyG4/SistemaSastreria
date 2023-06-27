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
                @if(in_array('nota_ingreso.crear', $permisos))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarMaterial"><i class="fa fa-plus"></i> Agregar materiales</button>
                @endif
                @if(in_array('nota_salida.crear', $permisos))
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalSacarMaterial"><i class="fa fa-minus"></i> Sacar materiales</button>
                @endif
            </div>
        </div>


        <div class="ibox-content">
        @if($datos->count())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Material</th>
                        <th scope="col">Cantidad (Stock)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datos as $dato)
                    <tr>
                        <td>{{ $dato->material->nombre }}</td>
                        <td>{{ $dato->cantidad }} ({{ $dato->material->medida->tipo_medida }})</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <span>No hay datos en el inventario</span>
            @endif

            @if( $datos->hasPages() )
            <div class="px-6 py-3">
                {{ $datos->links() }}
            </div>
            @endif
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
                        <h2 class="modal-title" id="agregarMaterial"><b>Crear Nota de ingreso</b></h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">

                        <h4>Agregar</h4>
                        <form wire:submit.prevent="guardarNotaIngreso" id="form-id">
                            @csrf

                            <div class="row">

                                <div class="col-md-4">
                                    <label for="id_material">Material</label>
                                    <select wire:model="id_material" id="id_material" class="form-control">
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
                                    <input type="number" min="1" step="1" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                                    @error('cantidad')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="precio">Precio</label>
                                    <input type="number" id="precio" min="0" class="form-control" wire:model.lazy="precio">
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
                                    <td><input readonly type="text" class="form-control col-md-4" value="{{ $detalle->material->nombre }} " id=""></td>
                                    <td><input readonly type="text" class="form-control col-md-3" wire:model="detalles.{{$index}}.cantidad" id=""></td>
                                    <td><input readonly type="text" class="form-control col-md-3" wire:model="detalles.{{$index}}.precio" id=""></td>
                                    <td>
                                        <button wire:click="quitarMaterialIngreso({{$index}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else

                        @if (session()->has('message'))
                        <div class="alert alert-danger">
                            <p style="display: flex; justify-content: center;">Nota de ingreso vacia!!</p>
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <p style="display: flex; justify-content: center;">Nota de ingreso vacia!!</p>
                        </div>
                        @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                        <button type="submit" form="form-id" class="btn btn-primary">Crear nota de ingreso</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de sacar materiales -->
        <div wire:ignore.self id="modalSacarMaterial" class="modal fade" tabindex="-1" aria-labelledby="sacarMaterial" aria-hidden="true" data-bs-keyboard="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="sacarMaterial"><b>Crear Nota de salida</b></h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">

                        <h4><b><span class="text-danger">NOTA: Solo se mostraran materiales con stock > 0</span></b></h4>

                        <form wire:submit.prevent="adicionarMaterialSalida" id="form-id-sm">
                            @csrf

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="id_material_sm">Material</label>
                                    <select wire:model="id_material" id="id_material_sm" class="form-control">
                                        <option value="">Seleccione uno</option>
                                        @foreach($datos as $dato)
                                        @if($dato->cantidad > 0)
                                        <option value="{{ $dato->material->id }}">{{ $dato->material->nombre }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @error('id_material')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="stock">Stock</label>
                                    @if($id_material != null)
                                    @foreach($datos as $dato)
                                    @if($dato->id_material == $id_material)
                                    <input readonly type="number" id="stock" class="form-control" disabled value="{{ $dato->cantidad }}">
                                    @break
                                    @endif
                                    @endforeach
                                    @else
                                    <input readonly type="number" id="stock" class="form-control" disabled value="">
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <label for="cantidad-sm">Cant. a sacar</label>
                                    @if($id_material != null)
                                    @foreach($datos as $dato)
                                    @if($dato->id_material == $id_material)
                                    <input type="number" min="1" max="{{ $dato->cantidad }}" step="1" id="cantidad-sm" class="form-control" wire:model.lazy="cantidad">
                                    @break
                                    @endif
                                    @endforeach
                                    @else
                                    <input type="number" min="1" step="1" id="cantidad-sm" class="form-control" wire:model.lazy="cantidad">
                                    @endif
                                    @error('cantidad')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <br>
                                    <button type="submit" form="form-id-sm" class="btn btn-outline btn-success dim" type="button"><i class="fa fa-arrow-down"></i></button>
                                </div>
                            </div>
                        </form>

                        <h4>Materiales a sacar</h4>

                        @if(!$detallesSalida->isEmpty())
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Material</th>
                                    <th scope="col">Cant. a sacar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detallesSalida as $index => $detalle)
                                <tr>
                                    <td><input readonly type="text" class="form-control col-md-4" value="{{ $detalle->material->nombre }} " id=""></td>
                                    <td><input readonly type="text" class="form-control col-md-3" wire:model="detallesSalida.{{$index}}.cantidad" id=""></td>
                                    <td>
                                        <button wire:click="quitarMaterialSalida({{$index}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="form-group">
                            <label for="descripcion">Descripcion (Motivo de salida de inventario)</label>
                            <textarea wire:model="descripcion" class="form-control" id="descripcion" maxlength="100" rows="3"></textarea>
                        </div>
                        @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @else

                        @if (session()->has('message'))
                        <div class="alert alert-danger">
                            <p style="display: flex; justify-content: center;">Nota de salida vacia!!</p>
                        </div>
                        @else
                        <div class="alert alert-warning">
                            <p style="display: flex; justify-content: center;">Nota de salida vacia!!</p>
                        </div>
                        @endif
                        @endif


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar"> Cancelar</button>
                        <button wire:click="guardarNotaSalida" class="btn btn-primary">Crear nota de ingreso</button>
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
        window.addEventListener('cerrar-modal-sm', event => {
            $('#modalSacarMaterial').modal('hide');
        });
    </script>

    <script>
        Livewire.on('notaIngresoCreada', function() {
            Swal.fire(
                'Nota de Ingreso agregada!',
                'La Nota de Ingreso ha sido agregada correctamente!',
                'success'
            )
        })

        Livewire.on('notaSalidaCreada', function() {
            Swal.fire(
                'Nota de Salida creada!',
                'La Nota de Salida ha sido registrada correctamente!',
                'success'
            )
        })
    </script>
    @endpush