<div>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalDeCreacion" wire:click="resetModal"><i class="fa fa-user-plus"></i> Añadir cliente</button>

    <!-- Modal de creacion -->
    <div wire:ignore.self id="modalDeCreacion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="crearCliente" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="crearCliente">Crear cliente</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body text-start">
                    <h4>Rellene los datos:</h4>
                    <form wire:submit.prevent="store" id="form-id">
                        @csrf
                        <label for="nombre"><b>Nombre :</b></label>
                        <input type="text" id="nombre" class="form-control" wire:model.lazy="nombre">
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="apellido"><b>Apellido :</b></label>
                        <input type="text" id="apellido" class="form-control" wire:model.lazy="apellido">
                        @error('apellido')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="ci"><b>C.I. :</b></label>
                        <input type="number" id="ci" class="form-control" wire:model.lazy="ci">
                        @error('ci')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="direccion"><b>Dirección :</b></label>
                        <input type="text" id="direccion" class="form-control" wire:model.lazy="direccion">
                        @error('direccion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                        <label for="telefono"><b>Telefono :</b></label>
                        <input type="number" id="telefono" class="form-control" wire:model.lazy="telefono">
                        @error('telefono')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancelar</button>
                    <button type="submit" form="form-id" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </div>
    </div>
</div>