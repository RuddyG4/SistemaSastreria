<x-slot:title>
    Roles
</x-slot>
<div>
    <h2> Gestión de Roles</h2>
    {{-- <h3>Lista de roles:</h3>     --}}
    <button class="btn btn-primary" wire:click="loadRol" data-bs-toggle="modal" data-bs-target="#modalDeCreacion" >Crear Rol</button>
    idrol={{var_export($idRol)}}
    {{var_export($afuera)}}
    <table class="table table-striped" >
        <thead>
            <tr >
                <th>Nombre del rol</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
            <tr>
                <input type="hidden" value={{$rol->id}}>
                <td>{{ $rol->nombre }}</td>
                <td>{{ $rol->descripcion }}</td>
                <td>
                    <button  data-bs-toggle="modal" data-bs-target="#modalDeEditar" class="btn btn-primary"    wire:click="edit({{$rol->id}})" >Editar</button>
                    <button  data-bs-toggle="modal" data-bs-target="#modalDeVer"    class="btn btn-secondary"  wire:click="view({{$rol->id}})" >Ver</button>
                    <button  data-bs-toggle="modal" data-bs-target="#modalDeDelete" class="btn btn-danger"     wire:click="$set('idRol', {{ $rol->id }})">Eliminar</button>   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    {{-- create modal --}}
    <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearrol" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearrol">Crear rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    {{var_export($rolPermisos)}}
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" class="form-control" wire:model.lazy="descripcion">
                        @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        @foreach ($funcList as $funcion)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model="rolPermisos" value="{{$funcion->id}}">
                                <label class="form-check-label" >{{$funcion->nombre}}</label>
                              </div>
                        @endforeach
                        <br>
                        @error('permisos')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </div>

    {{-- view modal --}}
    <div wire:ignore.self id="modalDeVer" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="verrol" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verrol">Ver rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h2>{{$nombre}}</h2>
                    @foreach ($rolPermisos as $permiso )
                        <li>{{ $permiso }}</li>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" form="form-id" class="btn btn-primary">Editar</button>
                    <button type="button" class="btn btn-secondary" wire:click="cerrar"> Cerrar</button>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de eliminar -->
    <div wire:ignore.self id="modalDeDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="eliminarrol" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarrol">Eliminar Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h2>Seguro que quieres eliminar el rol?</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="cerrar">Cancelar</button>
                    <button id="eliminar" type="button" class="btn btn-secondary" wire:click="delete" >Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de editar -->
    <div wire:ignore.self id="modalDeEditar" class="modal fade" tabindex="1" role="dialog" aria-labelledby="editarrol" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarrol">Editar rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cerrar"></button>
                </div>
                <div class="modal-body">
                    <h3>editar</h3>
                    {{-- <h2>{{$nombre}}</h2> --}}
                    rol permisos{{var_export($rolPermisos)}}
                    

                    <form wire:submit.prevent="update" id="form-edit">
                        @csrf
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="descripcion">Descripcion</label>
                        <input type="text" id="descripcion" class="form-control" wire:model.lazy="descripcion">
                        @error('descripcion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                        @foreach ($funcList as $funcion)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model="rolPermisos" value="{{$funcion->id}}">
                                <label class="form-check-label" >{{$funcion->nombre}}</label>
                              </div>
                        @endforeach

                        <br>
                        @error('permisos')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        
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
