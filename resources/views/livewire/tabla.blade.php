<div>
    <h2> Gestión de Roles</h2>
    <h3>Lista de roles:</h3>
    
    {{-- <h1>{{$idEdit}}</h1> --}}
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
                    <button type="button" wire:click="showModel({{$rol->id}})"  class="btn btn-primary" >Editar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>   
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
                    <h5 class="modal-title">Editar Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="showoff">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <Form wire:submit.prevent >
                    {{-- <Form method="POST" action="#" wire:submit.prevent> --}}
                        <label>Nombre Rol </label>
                        <input type="text" wire:model="titulo" >
                        <label>descripcion Rol: </label>
                        <input type="text" wire:model="descripcion">
                    </Form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="showoff">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="savedato">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
        
    {{-- <h4>Permisos de cada rol:</h4>
<ul>
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
