<x-slot:title>
    Roles
</x-slot>
<div>
    <h2> Gestión de Roles</h2>
    <h3>Lista de roles:</h3>
    CheckBox: {{var_export($checkBox)}}
    <button type="button" wire:click="showModel()"  class="btn btn-primary" >Nuevo Rol</button>

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
                    <button type="button" wire:click="editar({{$rol->id}})"  class="btn btn-primary" >Editar</button>
                    <button type="button" wire:click="deleteRol({{$rol->id}})"class="btn btn-danger">Eliminar</button>   
                    <button type="button" wire:click="ver({{$rol->id}})"class="btn btn-secondary">Ver</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- new user model --}}
    @if ($showNew)

    <h1>mirar {{$idEdit}}</h1>
    <div class="modal" data-bs-backdrop="static" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered"  >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$contenido}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="showoff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf
                        <Form wire:submit.prevent >
                          <label>Nombre Rol </label>
                            <input type="text" wire:model="nombre" >
                            <label>descripcion Rol: </label>
                            <input type="text" wire:model="descripcion">
                            
                            @foreach ($permisos as $tipo )
                            <br>
                            <h3>{{$tipo}}</h3>
                                @foreach ($tipoPermiso as $permiso )
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1-{{$tipo}}-{{$permiso}}" wire:model="checkBox" value="{{$tipo}}.{{$permiso}}">
                                    <label class="form-check-label" for="inlineCheckbox1-{{$tipo}}-{{$permiso}}">{{$permiso}}</label>
                                  </div>
                                @endforeach
                                
                            @endforeach
                        </Form>                               
                </div>
                <div class="modal-footer">
                  
                    <button type="button" class="btn btn-primary" wire:click="savedato">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>                              
                </div>
            </div>
        </div>
    </div>  
    
    @endif

    {{-- edit rol model --}}
    @if ($showEdit)

    <h1>mirar {{$idEdit}}</h1>
    <div class="modal" data-bs-backdrop="static" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$contenido}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="showoff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @csrf
                        <Form wire:submit.prevent >
                          <label>Nombre Rol </label>
                            <input type="text" wire:model="nombre" >
                            <label>descripcion Rol: </label>
                            <input type="text" wire:model="descripcion">
                            @foreach ($tipo as $key => $values)
                            <br>
                            <h3>{{$key}}</h3>
                                @foreach ($values as $value )
                                @if (in_array($value, $tipoPermiso))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="">
                                        <label class="form-check-label" for="inlineCheckbox1">{{$value}}</label>
                                    </div>
                                @else
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="">
                                        <label class="form-check-label" for="inlineCheckbox1">{{$value}}</label>
                                    </div>
                                @endif
                                {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="">
                                    <label class="form-check-label" for="inlineCheckbox1">{{$value}}</label>
                                  </div> --}}
                                {{-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="flexCheckChecked-{{$value}}" wire:model="checkBox" value="{{$value}}" checked>
                                    <label class="form-check-label" for="flexCheckChecked-{{$value}}">{{$value}}</label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$key}}.{{$value}}" id="flexCheckChecked-{{$key}}.{{$value}}" checked>
                                    <label class="form-check-label" for="flexCheckChecked-{{$key}}.{{$value}}">
                                        {{$value}}
                                    </label>
                                  </div>   --}}
                                @endforeach
                                
                            @endforeach
                             

                        </Form>
                </div>
                <div class="modal-footer">                   
                    <button type="button" class="btn btn-primary" wire:click="saveEdit">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>                 
                </div>
            </div>
        </div>
    </div>  

    
    @endif

    {{-- detele rol model --}}
    @if ($showDelete)

    <h1>mirar {{$idEdit}}</h1>
    <div class="modal" data-bs-backdrop="static" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$contenido}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="showoff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title">Seguro que quiere eliminar este rol?</h5>
                    
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" wire:click="Delete" data-dismiss="modal" >Eliminar</button>
                    <button type="button" class="btn btn-danger" wire:click="showoff">Cancelar</button>
                </div>
            </div>
        </div>
    </div>  
    @endif

    @if ($show)

    <h1>mirar {{$idEdit}}</h1>
    <div class="modal" data-bs-backdrop="static" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{$contenido}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="showoff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                       
                    @foreach($tipo as $key => $values)
                    <h2>{{ $key }}</h2>
                    <ul>
                        @foreach($values as $value)
                            <li>{{ $value }}</li>
                        @endforeach
                    </ul>
                @endforeach
                         
                        
                </div>
                <div class="modal-footer">                   
                    <button type="button" class="btn btn-primary" wire:click="saveEdit">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>                 
                </div>
            </div>
        </div>
    </div>  
    @endif
        
    
    {{var_export($afuera)}}

    {{-- <table class="table table-striped" >
        <thead>
            <tr >
                <th>Nombre del rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $rol)
            <tr>
                <input type="hidden" value={{$rol->id}}>
                <td>{{ $rol->nombre }}</td>
                <td>
                    <button type="button" class="btn btn-primary" >Editar</button> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}
{{-- <ul>
@foreach($roles as $rol)
<li>{{ $rol->nombre }}</li>
<ul>
@foreach($rol->funcionalidades as $funcionalidad)
<li>{{ $funcionalidad->nombre}}</li>
@endforeach
</ul>
@endforeach
</ul> --}}
<div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearUsuario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuario">Crear usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close" wire:click="cancelar"></button>
            </div>
            <div class="modal-body">
                <h6>Rellene los datos:</h6>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelar"> Cancelar</button>
                <button type="submit" form="form-id" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</div>
