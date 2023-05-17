<h2> Gestión de usuarios</h2>

<h3>Lista de usuarios:</h3>

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
            <td> Editar | Dar de baja</td>
        </tr>
        @endforeach
    </tbody>
</table>