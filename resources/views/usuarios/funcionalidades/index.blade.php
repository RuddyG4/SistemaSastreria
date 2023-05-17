<h2> Gestión de funcionalidades</h2>

<h3>Lista de funcionalidades:</h3>

<table>
    <thead>
        <tr>
            <th>Nombre de funcionalidad</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($funcionalidades as $funcionalidad)
        <tr>
            <td>{{ $funcionalidad->nombre }}</td>
            <td>{{ $funcionalidad->descripcion }}</td>
            <td>Editar | Eliminar</td>
        </tr>
        @endforeach
    </tbody>
</table>