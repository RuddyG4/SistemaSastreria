<x-app>
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
                                {{ $totalPedidos }}
                            </span>
                            <div>
                                <small>Total Pedidos</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{ $pedidosPendientes }}
                            </span>
                            <div>
                                <small>Pendientes</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{ ($totalPedidos - $pedidosPendientes) }}
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
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-9">
                        <h3>Todos los Pedidos</h3>
                    </div>
                    <div class="col-sm-3 d-flex align-items-end justify-content-end">
                        <a href="{{ url('/dashboard/adm_servicios/pedidos/crear') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Crear Nuevo</span>
                        </a>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <livewire:servicios.pedidos />
            </div>

        </div>
</x-app>