<h2> Gestión de Roles</h2>

<h3>Lista de roles:</h3>

<table>
    <thead>
        <tr>
            <th>Nombre del rol</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($roles as $rol)
        <tr>
            <td>{{ $rol->nombre }}</td>
            <td>{{ $rol->descripcion }}</td>
            <td>Editar | Eliminar</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h4>Permisos de cada rol:</h4>
<ul>
@foreach($roles as $rol)
<li>{{ $rol->nombre }}</li>
<ul>
@foreach($rol->funcionalidades as $funcionalidad)
<li>{{ $funcionalidad->nombre}}</li>
@endforeach
</ul>
@endforeach
</ul>