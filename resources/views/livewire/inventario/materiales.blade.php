<x-slot:title>
    Material
    </x-slot>

<div>
    <h1>Materiales</h1>

    <input type="text" wire:model="busqueda" name="busqueda" id="busqueda">

    <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalDeCreacion">Nuevo Material</button>

    <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalMedida">Medida</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Tipo Unidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $listMaterial as $materiales )
            <tr>
                <td> {{$materiales->nombre}}</td>  
                <td> {{$materiales->tipo_medida}}</td>  
                <td>
                    <button data-bs-toggle="modal" data-bs-target="#modalDeEditar" class="btn btn-primary" wire:click="editar({{$materiales->id}})">Editar</button>
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

                        <label for="medida">Medida</label>
                        <select id="medida" wire:model="medida"  >
                            @foreach ($listMedida as $list)
                            <option value="{{$list->id}}">{{$list->tipo_medida}}</option>
                            @endforeach
                        </select>
                        @error('medida')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

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

                        <label for="medida">Medida</label>
                        <select id="medida" wire:model="medida"  >
                            @foreach ($listMedida as $list)
                            <option value="{{$list->id}}">{{$list->tipo_medida}}</option>
                            @endforeach
                        </select>
                        @error('medida')
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




{{-- modales de medida --}}

    
    <div wire:ignore.self id="modalMedida" class="modal fade" tabindex="1" role="dialog" aria-labelledby="crearMedida" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="crearMedida">Medidas</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrarMedida"></button>
                </div>
                <div class="modal-body">    
                    <button class="btn btn-success" wire:click="" data-bs-toggle="modal" data-bs-target="#modalMedidaNuevo">crear</button>   
                           
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tipo Unidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listMedida as $list)
                                    <tr>
                                        <td> {{$list->tipo_medida}}</td> 
                                        <td>                                
                                            <button data-bs-toggle="modal" data-bs-target="#modalDarBaja" class="btn btn-danger" wire:click="$set('idMedida', {{ $list->id }})">Dar Baja</button>
                                        </td>
                                    </tr> 
                                    @endforeach            
                                </tbody>
                            </table>
                </div>
                <div class="modal-footer">
                
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self id="modalMedidaNuevo" class="modal fade" tabindex="1" role="dialog" aria-labelledby="medidaCrear" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="medidaCrear">Medidas</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrarMedida"></button>
                </div>
                <div class="modal-body">              
                    <form wire:submit.prevent="storeMedida" id="form-id-medida">
            

                        @csrf
                        <label for="nombreMedida">Nombre</label>
                        <input type="text" id="nombreMedida" class="form-control" wire:model.lazy="nombreMedida">
                        @error('nombreMedida')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrarMedida"> Cancelar</button>
                    <button type="submit" form="form-id-medida" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>



    <div wire:ignore.self id="modalDarBaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="DarBajaMedida" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="DarBajaMedida">Dar de baja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h2>Seguro que quieres dar de baja esta medida?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cerrar">Cancelar</button>
                    <button id="eliminar" type="button" class="btn btn-secondary" wire:click="DarBaja">Eliminar</button>
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
        window.addEventListener('cerrar-modal-eliminar', event => {
            $('#modalDeDelete').modal('hide');
        });
        window.addEventListener('cerrar-modal-editar', event => {
            $('#modalDeEditar').modal('hide');
        });

        
        window.addEventListener('cerrar-modal-medida', event => {
            $('#modalMedida').modal('hide');
        });
        window.addEventListener('cerrar-modal-crear-medida', event => {
            $('#modalMedidaNuevo').modal('hide');
        });
        window.addEventListener('cerrar-modal-baja-medida', event => {
            $('#modalDarBaja').modal('hide');
        });
    </script>
    @endpush