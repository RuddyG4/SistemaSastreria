<x-slot:title>
    Notas
    </x-slot>
    <div>

        <h1><b>Notas de Ingreso/Salida de inventario</b></h1>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h3><strong>Notas de Ingreso</strong></h3>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Almacen</th>
                                    <th>Creado por</th>
                                    <th>Fecha - Hora</th>
                                    <th>Monto Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notasIngreso as $nota)
                                <tr>
                                    <td>{{ $nota->id }}</td>
                                    <td>{{ $nota->almacen->nombre }}</td>
                                    <td>{{ $nota->usuario->username }}</td>
                                    <td>{{ $nota->fecha }}</td>
                                    <td>{{ $nota->monto_total }}</td>
                                    <td>
                                        @if(in_array('nota_ingreso.ver', $permisos))
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verDetallesIngreso" wire:click="cargarNotaIngreso( {{ $nota->id }} )"><i class="fa fa-eye"></i></button>
                                        @endif
                                        @if(in_array('nota_ingreso.modificar', $permisos))
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarNotaIngreso" wire:click="cargarNotaIngreso( {{ $nota->id }} )"><i class="fa fa-edit"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if( $notasIngreso->hasPages() )
                        <div class="px-6 py-3">
                            {{ $notasIngreso->links() }}
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h3><strong>Notas de Salida</strong></h3>
                    </div>
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Almacen</th>
                                    <th>Creado por</th>
                                    <th>Fecha - Hora</th>
                                    <th>Motivo de salida</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notasSalida as $nota)
                                <tr>
                                    <td>{{ $nota->id }}</td>
                                    <td>{{ $nota->almacen->nombre }}</td>
                                    <td>{{ $nota->usuario->username }}</td>
                                    <td>{{ $nota->fecha }}</td>
                                    <td>{{ $nota->descripcion }}</td>
                                    <td>
                                        @if(in_array('nota_salida.ver', $permisos))
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verDetallesSalida" wire:click="cargarNotaSalida( {{ $nota->id }} )"><i class="fa fa-eye"></i></button>
                                        @endif
                                        @if(in_array('nota_salida.modificar', $permisos))
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarNotaSalida" wire:click="cargarNotaSalida( {{ $nota->id }} )"><i class="fa fa-edit"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODALES -->

        <!-- Modales para NOTAS DE INGRESO -->
        <!-- Modal para editar notas de ingreso -->
        <div wire:ignore.self id="editarNotaIngreso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edicionNotaIngreso" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="edicionNotaIngreso"><b>Editar Nota de Ingreso</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="actualizarNotaIngreso" id="editarNIForm">

                            <label><strong>ID Nota de ingreso :</strong></label>
                            <span>{{ $notaIngreso->id}}</span>
                            <br>
                            <label><strong>Fecha:</strong></label>
                            <span>{{ $notaIngreso->fecha }}</span>
                            <br>
                            <label><strong>Monto Total actual:</strong></label>
                            <span>{{ $notaIngreso->monto_total }}</span>
                            <br>
                            <span><strong>Detalles:</strong></span>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notaIngreso->detalles as $i => $detalle)
                                    <tr>
                                        <td>{{ $detalle->id }}</td>
                                        <td class="col-md-4">
                                            <select wire:model="notaIngreso.detalles.{{ $i }}.id_material" class="form-control">
                                                @foreach($materiales as $material)
                                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('notaIngreso.detalles.'.$i.'.id_material')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-md-3">
                                            <input type="number" class="form-control" min="{{ $detalle->getOriginal('cantidad') - $detalle->material->getInventario($notaIngreso->id_almacen)->cantidad }}" wire:model.lazy="notaIngreso.detalles.{{ $i }}.cantidad">
                                            @error('notaIngreso.detalles.'.$i.'.cantidad')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-md-3">
                                            <input type="number" class="form-control" wire:model.lazy="notaIngreso.detalles.{{ $i }}.precio">
                                            @error('notaIngreso.detalles.'.$i.'.precio')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <!-- <td>
                                            <button wire:click="eliminarDetalleNotaIngreso({{$i}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar">Cancelar</button>
                        <button type="submit" form="editarNIForm" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver detalles de notas de ingreso -->
        <div wire:ignore.self id="verDetallesIngreso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detallesIngreso" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="detallesIngreso"><b>Nota de ingreso</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">

                        <label><strong>ID:</strong></label>
                        <span>{{ $notaIngreso->id}}</span>
                        <br>
                        <label><strong>Fecha:</strong></label>
                        <span>{{ $notaIngreso->fecha }}</span>
                        <br>
                        <label><strong>Monto Total actual:</strong></label>
                        <span>{{ $notaIngreso->monto_total }}</span>
                        <br>
                        <span><strong>Detalles:</strong></span>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notaIngreso->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->material->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ $detalle->precio }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="cancelar">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modales para NOTAS DE SALIDA -->
        <!-- Modal para editar notas de Salida -->
        <div wire:ignore.self id="editarNotaSalida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edicionNotaSalida" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="edicionNotaSalida"><b>Editar Nota de Salida</b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="actualizarNotaSalida" id="editarNSForm">

                            <label><strong>ID :</strong></label>
                            <span>{{ $notaSalida->id}}</span>
                            <br>
                            <label><strong>Fecha - Hora:</strong></label>
                            <span>{{ $notaSalida->fecha }}</span>
                            <br>
                            <label><strong>Descripcion (Motivo de salida de inventario)</strong></label>
                            <textarea wire:model.lazy="notaSalida.descripcion" class="form-control" id="descripcion-nse" maxlength="100" rows="3"></textarea>
                            <br>
                            <span><strong>Detalles:</strong></span>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Material</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($notaSalida->detalles as $i => $detalle)
                                    <tr>
                                        <td class="col-md-4">
                                            <select wire:model="notaSalida.detalles.{{ $i }}.id_material" class="form-control">
                                                @foreach($materiales as $material)
                                                <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('notaSalida.detalles.'.$i.'.id_material')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>

                                        <td class="col-md-3">
                                            <input type="number" min="1" max="{{ $detalle->material->getInventario($notaSalida->id_almacen)->cantidad + $detalle->getOriginal('cantidad') }}" class="form-control" wire:model.lazy="notaSalida.detalles.{{ $i }}.cantidad">
                                            @error('notaSalida.detalles.'.$i.'.cantidad')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <!-- <td>
                                            <button wire:click="eliminarDetalleNotaIngreso({{$i}})" class="btn btn-outline btn-danger dim col" type="button"><i class="fa fa-minus"></i></button>
                                        </td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar">Cancelar</button>
                        <button type="submit" form="editarNSForm" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para ver detalles de Notas de salida -->
        <div wire:ignore.self id="verDetallesSalida" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detallesSalida" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="detallesSalida"><b>Nota de Salida </b></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
                    </div>
                    <div class="modal-body">

                        <label><strong>ID :</strong></label>
                        <span>{{ $notaSalida->id}}</span>
                        <br>
                        <label><strong>Fecha - Hora:</strong></label>
                        <span>{{ $notaSalida->fecha }}</span>
                        <br>
                        <label><strong>Descripcion:</strong></label>
                        <span>{{ $notaSalida->descripcion }}</span>
                        <br>
                        <span><strong>Detalles:</strong></span>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notaSalida->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->material->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click="cancelar">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.addEventListener('cerrar-detalles-ni', event => {
            $('#verDetallesIngreso').modal('hide');
        });
        window.addEventListener('cerrar-detalles-ns', event => {
            $('#verDetallesSalida').modal('hide');
        });
        window.addEventListener('cerrar-edicion-ni', event => {
            $('#editarNotaIngreso').modal('hide');
        });
        window.addEventListener('cerrar-edicion-ns', event => {
            $('#editarNotaSalida').modal('hide');
        });
    </script>

    <script>
        Livewire.on('notaIngresoActualizada', function() {
            Swal.fire(
                'Nota de Ingreso actualizada!',
                'La Nota de Ingreso ha sido actualizada correctamente!',
                'success'
            )
        })

        Livewire.on('notaSalidaActualizada', function() {
            Swal.fire(
                'Nota de Salida actualizada!',
                'La Nota de Salida ha sido actualizada correctamente!',
                'success'
            )
        })
    </script>
    @endpush