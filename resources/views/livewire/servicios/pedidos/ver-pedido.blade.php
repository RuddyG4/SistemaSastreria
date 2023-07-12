<x-app>
    <x-slot:title>
        Ver pedido
        </x-slot>
        <!-- Código aquí -->
        <div class="row">
            <div class="col-lg-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2>Contrato con Fulanito</h2>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <a href="#" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Editar pedido</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <dl class="row mb-0">
                                        <div class="col-sm-4" style="text-align: right;">
                                            <dt>Estado:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"><span class="label label-primary">En proceso</span></dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4" style="text-align: right;">
                                            <dt>Creado por:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">ruddygh</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4" style="text-align: right;">
                                            <dt>Vestimentas:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"> 154</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4" style="text-align: right;">
                                            <dt>Cliente:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1">Fulanito </dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-4" style="text-align: right;">
                                            <dt>Tipo de pedido:</dt>
                                        </div>
                                        <div class="col-sm-8 text-sm-left">
                                            <dd class="mb-1"><i class="fa fa-user"></i> Personal </dd>
                                        </div>
                                    </dl>

                                </div>
                                <div class="col-lg-6" id="cluster_info">

                                    <dl class="row mb-0">
                                        <div class="col-sm-6" style="text-align: right;">
                                            <dt>Última Actualización:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"><i class="fa fa-calendar"></i> 12/07/23 12:40:14</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-6" style="text-align: right;">
                                            <dt>Creado:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"><i class="fa fa-calendar"></i> 2023-07-07 11:40:14</dd>
                                        </div>
                                    </dl>
                                    <dl class="row mb-0">
                                        <div class="col-sm-6" style="text-align: right;">
                                            <dt>Descripcion:</dt>
                                        </div>
                                        <div class="col-sm-6 text-sm-left">
                                            <dd class="mb-1"> Pedido para una persona particular</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="row mb-0">
                                        <div class="col-sm-2" style="text-align: right;">
                                            <dt>Completado:</dt>
                                        </div>
                                        <div class="col-sm-10 text-sm-left">
                                            <dd>
                                                <div class="progress m-b-1">
                                                    <div style="width: 60%;" class="progress-bar progress-bar-striped progress-bar-warning"></div>
                                                </div>
                                                <small>Pedido finalizado en un <strong>60%</strong>.</small>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>
                            <!-- inicio  tabs-->
                            <div class="ibox-content">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"><i class="fa fa-scissors fa-2x"></i> Detalles de vestimentas</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><i class="fa fa-calendar fa-2x"></i> Fechas de pago</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="full-height-scroll">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>prenda 1</th>
                                                            <th>prenda 2</th>
                                                            <th>prenda 3</th>
                                                            <th>prenda 4</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                Jorge
                                                            </td>
                                                            <td>
                                                                camisa
                                                            </td>
                                                            <td>
                                                                saco
                                                            </td>
                                                            <td>
                                                                chaleco
                                                            </td>
                                                            <td>
                                                                pantalon
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                camila
                                                            </td>
                                                            <td>
                                                                camisa
                                                            </td>
                                                            <td>
                                                                saco
                                                            </td>
                                                            <td>
                                                                chaleco
                                                            </td>
                                                            <td>
                                                                pantalon
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                patricio
                                                            </td>
                                                            <td>
                                                                camisa
                                                            </td>
                                                            <td>
                                                                saco
                                                            </td>
                                                            <td>
                                                                chaleco
                                                            </td>
                                                            <td>
                                                                pantalon
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tab-2" class="tab-pane">
                                        <div class="full-height-scroll">
                                            <div class="table-responsive">
                                                <div class="ibox-content" id="ibox-content">
                                                    <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation">
                                                        <div class="vertical-timeline-block">
                                                            <div class="vertical-timeline-icon navy-bg">
                                                                <i class="fa fa-calendar-o"></i>
                                                            </div>
                                                            <div class="vertical-timeline-content">
                                                                <h2>Primer Pago</h2>
                                                                <p>El pago realizado el dia de la realizacion del pedido</p>
                                                                <dl class="row mb-0">
                                                                    <div class="col-sm-4">
                                                                        <dt>Estado:</dt>
                                                                    </div>
                                                                    <div class="col-sm-8" style="text-align: right;">
                                                                        <dd class="mb-1"><span class="label label-primary">Cancelado</span></dd>
                                                                    </div>
                                                                </dl>
                                                                <span class="vertical-date">
                                                                    Fecha de Pago <br />
                                                                    <small>2023-07-07 11:40:14</small>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="vertical-timeline-block">
                                                            <div class="vertical-timeline-icon blue-bg">
                                                                <i class="fa fa-calendar-o"></i>
                                                            </div>

                                                            <div class="vertical-timeline-content">
                                                                <h2>x- pago</h2>
                                                                <p>x- pago con el monto de pago de XX</p>
                                                                <dl class="row mb-0">
                                                                    <div class="col-sm-4">
                                                                        <dt>Estado:</dt>
                                                                    </div>
                                                                    <div class="col-sm-8" style="text-align: right;">
                                                                        <dd class="mb-1"><span class="label label-warning">Pendiente</span></dd>
                                                                    </div>
                                                                </dl>
                                                                <span class="vertical-date">
                                                                    Fecha de Pago <br />
                                                                    <small>2023-09-07</small>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="vertical-timeline-block">
                                                            <div class="vertical-timeline-icon lazur-bg">
                                                                <i class="fa fa-calendar-o"></i>
                                                            </div>

                                                            <div class="vertical-timeline-content">
                                                                <h2>x- pago</h2>
                                                                <p>x- pago con el monto de pago de XX</p>
                                                                <dl class="row mb-0">
                                                                    <div class="col-sm-4">
                                                                        <dt>Estado:</dt>
                                                                    </div>
                                                                    <div class="col-sm-8" style="text-align: right;">
                                                                        <dd class="mb-1"><span class="label label-warning">Pendiente</span></dd>
                                                                    </div>
                                                                </dl>
                                                                <span class="vertical-date">
                                                                    Fecha de Pago <br />
                                                                    <small>2023-12-07</small>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="wrapper wrapper-content project-manager">
                    <div class="contact-box center-version p-4">
                        <div class="text-center">
                            <i class="fa fa-user-circle-o" style="font-size: 10em;"></i>
                        </div>
                        <h3 class="m-b-md text-center mt-3"><strong><i class="fa fa-address-book-o"></i> Fulano Perez</strong></h3>
                        <hr>
                        <div class="text-center">
                            <h4><i class="fa fa-phone"></i> 76621547</h4>
                            <h4><i class="fa fa-address-card-o"></i> 1535687</h4>
                            <h4><i class="fa fa-map-marker"></i> av. virgen de lujan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app>