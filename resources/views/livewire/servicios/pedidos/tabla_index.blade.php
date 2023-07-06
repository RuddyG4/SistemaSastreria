<div>
    <!-- INICIO TABLA PRINCIPAL -->
    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
        <thead>
            <tr>
                <th data-toggle="true">Id</th>
                <th data-toggle="true">Cliente</th>
                <th data-hide="phone">Telefono</th>
                <th data-hide="all">Descripcion</th>
                <th data-hide="phone">Estado avance</th>
                <th data-sort-ignore="true">Fecha Recepcion</th>
                <th data-sort-ignore="true">Tipo pedido</th>
                <th class="text-right" data-sort-ignore="true">
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->cliente->persona->nombre }}</td>
                <td>{{ $pedido->cliente->telefonoPersonal->numero }}</td>
                <td>{{ $pedido->descripcion }}</td>
                <td>
                    <?php
                    $pedidoSinAvance = $pedido->estado_avance == 0;
                    $pedidoCompletado = ($pedido->estado_avance == 1);
                    $pedidoEnProceso = !$pedidoSinAvance && !$pedidoCompletado;
                    ?>
                    <span @class([ 'label' , 'label-secondary'=> $pedidoSinAvance,
                        'label-primary'=> $pedidoCompletado,
                        'label-warning'=> $pedidoEnProceso,
                        ])>
                        {{ $pedido->estado_avance * 100 }} %
                    </span>
                </td>
                <td>{{ $pedido->fecha_recepcion }}</td>
                <td>{{ ($pedido->tipo == 0)?'Personal':'Grupal' }}</td>
                <td class="text-right">
                    <div class="btn-group">
                        <button class="btn btn-xs btn-warning">Detalles</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6">
                    {{ $pedidos->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
    <!-- FIN TABLA PRINCIPAL -->
</div>