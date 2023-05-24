<div>
    <h2> Gestión de Roles</h2>
    <h3>Lista de roles:</h3>
    
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

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
                    @if ($showEdit)
                        @csrf
                        <Form wire:submit.prevent >
                          <label>Nombre Rol </label>
                            <input type="text" wire:model="nombre" >
                            <label>descripcion Rol: </label>
                            <input type="text" wire:model="descripcion">
                        </Form>
                    @endif

                    @if ($showNew)
                        @csrf
                        <Form wire:submit.prevent >
                          <label>Nombre Rol </label>
                            <input type="text" wire:model="nombre" >
                            <label>descripcion Rol: </label>
                            <input type="text" wire:model="descripcion">
                        </Form>
                    @endif

                    @if ($showDelete)
                    <h5 class="modal-title">Seguro que quiere eliminar este rol?</h5>
                    @endif

                    
                </div>
                <div class="modal-footer">
                    
                    @if ($showDelete)
                    <button type="button" class="btn btn-primary" wire:click="Delete" data-dismiss="modal" >Eliminar</button>
                    <button type="button" class="btn btn-danger" wire:click="showoff">Cancelar</button>
                    
                    @endif
                    @if ($showEdit)
                    <button type="button" class="btn btn-primary" wire:click="saveEdit">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>
                    @endif

                    @if ($showNew)
                    <button type="button" class="btn btn-primary" wire:click="savedato">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>  
    @endif
        
    <h4>Permisos de cada rol:</h4>

    
          <div class="col-15" style="max-width: 500px;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre del rol</th>
                </tr>
              </thead>
              <tbody>
                @foreach($roles as $rol)
                <tr>
                  <input type="hidden" value={{$rol->id}}>
                  <td>{{ $rol->nombre }}</td>
                  <td style="max-width: 70px;">
                    <button type="button" class="btn btn-primary ">Ver</button>
                    <button type="button" class="btn btn-primary">Editar</button>
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
 
      

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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

</div>
