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
                    <button class="btn btn-primary" wire:click="editar">Editar</button> | Dar de baja
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <!-- Agrega el botón para abrir el modal -->
        <!-- <button class="btn btn-primary" wire:click="editUser">Editar Usuario</button> -->

        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="cerrarModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aquí puedes colocar el formulario para editar los datos del usuario -->
                        <!-- Por ejemplo, puedes utilizar wire:model para enlazar los campos con $editedUser -->
                        <input type="text" wire:model="usuarioEditado.username" class="form-control">
                        <input type="email" wire:model="usuarioEditado.email" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="closeModal">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="save">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>