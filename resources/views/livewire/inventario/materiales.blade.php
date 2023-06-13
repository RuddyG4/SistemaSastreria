<x-slot:title>
    Material
    </x-slot>

<div>
    {{-- {{var_export($listMaterial)}} --}}

    <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Nuevo Almacen</button>

    
    <label>Almance:</label>
    


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Tipo Unidad</th>
                <th>Almacen</th>
                <th>Ubicacion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $listMaterial as $materiales )
            <tr>
                <td> {{$materiales->nombre}}</td>  
                <td> {{$materiales->cantidad}}</td>  
                <td> {{$materiales->tipo_unidad}}</td> 
                <td> {{$materiales->nombreAlma}}</td> 
                <td> {{$materiales->ubicacion}}</td> 
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalDeEditar" class="btn btn-primary" wire:click="editar({{$materiales->id}})">Editar</button>
                    {{-- <button data-bs-toggle="modal" data-bs-target="#modalDeVer" class="btn btn-secondary" wire:click="">Ver</button> --}}
                    <button data-bs-toggle="modal" data-bs-target="#modalDeDelete" class="btn btn-danger" wire:click="$set('idMaterial', {{ $materiales->id }})">Eliminar</button>
                </td>
            </tr> 
            @endforeach            
        </tbody>
    </table>
    

    <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="newMaterial" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMaterial">Nuevo Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                                @error('cantidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="unidad">Unidad</label>
                                <input type="text" id="unidad" class="form-control" wire:model.lazy="unidad">
                                @error('unidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                        </div>
                        <br>

                        <label for="almacen">Almacén</label>
                        <select id="almacen" wire:model="almacen"  >
                            @foreach ($listAlma as $list)
                            <option value="{{$list->id}}">{{$list->nombre}}</option>
                            @endforeach
                        </select>
                        @error('almacen')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        {{var_export($almacen)}}

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self id="modalDeDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eliminarMaterial" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarMaterial">Eliminar material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h2>Seguro que quieres eliminar este material?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cerrar">Cancelar</button>
                    <button id="eliminar" type="button" class="btn btn-secondary" wire:click="delete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self id="modalDeEditar" class="modal fade" tabindex="1" role="dialog" aria-labelledby="editarMaterial" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editarMaterial">Editar Material</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                {{var_export($example)}}

                    <form wire:submit.prevent="update" id="form-edit">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <div class="row">
                            <div class="col">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" id="cantidad" class="form-control" wire:model.lazy="cantidad">
                                @error('cantidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="unidad">Unidad</label>
                                <input type="text" id="unidad" class="form-control" wire:model.lazy="unidad">
                                @error('unidad')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                        </div>
                        <br>

                        <label for="almacen">Almacén</label>
                        <select id="almacen" wire:model="almacen"  >
                            @foreach ($listAlma as $list)
                            <option value="{{$list->id}}">{{$list->nombre}}</option>
                            @endforeach
                        </select>
                        @error('almacen')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="form-edit">Guardar</button>
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cancelar</button>

                </div>
            </div>
        </div>
    </div>





</div>



@push('scripts')
    <script>
        window.addEventListener('cerrar-modal-crear', event => {
            $('#modalDeCreacion').modal('hide');
        });
        window.addEventListener('cerrar-modal-ver', event => {
            $('#modalDeVer').modal('hide');
        });
        window.addEventListener('cerrar-modal-eliminar', event => {
            $('#modalDeDelete').modal('hide');
        });
        window.addEventListener('cerrar-modal-editar', event => {
            $('#modalDeEditar').modal('hide');
        });
    </script>
    @endpush