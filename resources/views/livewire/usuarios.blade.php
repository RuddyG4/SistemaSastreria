<div>
    <h1>Vista de usuarios</h1>
    <input wire:model="busqueda" type="text">
    {{ $busqueda}}

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->username }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol->nombre }}</td>
                <td>
                    <button class="btn btn-primary" >Editar</button>
                    <button class="btn btn-danger" >Inactivar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modales -->

</div>