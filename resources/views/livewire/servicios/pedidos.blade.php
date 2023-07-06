<x-slot:title>
    Pedidos
</x-slot>
<div>
    <div class="ibox-content m-b-sm border-bottom">
        <div class="forum-item active">
            <div class="row">
                <div class="col-md-9">
                    <div class="forum-icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="forum_post.html" class="forum-item-title">Gestionar Pedidos</a>
                    <div class="forum-sub-title">Crear, Editar y Ver Pedidos.</div>
                </div>
                <div class="col-md-1 forum-info">
                    <span class="views-number">
                        1216
                    </span>
                    <div>
                        <small>Total Pedidos</small>
                    </div>
                </div>
                <div class="col-md-1 forum-info">
                    <span class="views-number">
                        368
                    </span>
                    <div>
                        <small>Pendientes</small>
                    </div>
                </div>
                <div class="col-md-1 forum-info">
                    <span class="views-number">
                        140
                    </span>
                    <div>
                        <small>Completados</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN TITULO -->
    <div class="row">
        <!-- INICIO FILTROS -->
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Agregar Filtros</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <!-- INICIO FILTROS-->
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-normal">Fecha de Recepcion</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cliente</label>
                                <input placeholder="Nombre Cliente" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="font-normal">Fecha de Entrega</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="">
                                </div>
                            </div>
                            <label class="font-normal">Estado</label>
                            <select class="form-control">
                                <option value="1">Todos</option>
                                <option value="2">Pendientes</option>
                                <option value="3">Completados</option>
                                <option value="4">Cancelados</option>
                            </select>
                        </div>
                        <!-- FIN FILTROS-->
                    </div>

                </div>
            </div>
        </div>
        <!-- FIN FILTROS -->
        <!-- INICIO PEDIDOS RECIENTES -->
        <div class="col-lg-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Pedidos Recientes</h5>
                </div>
                <div class="ibox-content">
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th data-toggle="true" style="padding: 3px !important;">Id</th>
                                <th data-toggle="true" style="padding: 3px !important;">Cliente</th>
                                <th class="text-right" style="padding: 3px !important;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="padding: 3px !important;">
                                <td style="padding: 3px !important;">1</td>
                                <td style="padding: 3px !important;">Jorge</td>
                                <td class="text-right" style="padding: 3px !important;">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-warning">Detalles</button>
                                    </div>
                                </td>
                            </tr>
                            <tr style="padding: 3px !important;">
                                <td style="padding: 3px !important;">2</td>
                                <td style="padding: 3px !important;">Manuelito</td>
                                <td class="text-right" style="padding: 3px !important;">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-warning">Detalles</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- FIN PEDIDOS RECIENTES -->
    </div>

    <!-- INICIO TABLA PRINCIPAL -->
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-9">
                <h3>Todos los Pedidos</h3>
            </div>
            <div class="col-sm-3 d-flex align-items-end justify-content-end">
                <button class="btn btn-success " type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Crear
                        Nuevo</span></button>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
            <thead>
                <tr>
                    <th data-toggle="true">Id</th>
                    <th data-toggle="true">Cliente</th>
                    <th data-hide="phone">Telefono</th>
                    <th data-hide="all">Descripcion</th>
                    <th data-hide="phone">Estado</th>
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
                    <td>Esto es una descripcion</td>
                    <td>
                        <span class="label label-primary">Terminado</span>
                        <!--
                                            <span class="label label-success">Pendiente</span>
                                            <span class="label label-danger">Cancelado</span>
                                          -->
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
                        <ul class="pagination float-right"></ul>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
    <!-- FIN TABLA PRINCIPAL -->
</div>
</div>