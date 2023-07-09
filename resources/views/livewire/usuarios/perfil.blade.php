<x-app>
    <x-slot:title>
        Bitacora
        </x-slot>
        <div>
            <div class="wrapper wrapper-content">
                <div class="row animated fadeInRight">
                    <div class="col-md-4">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h2>Detalles del Usuario</h2>
                            </div>
                            <div>
                                <div class="ibox-content no-top-border border-left-right">
                                    <div style="text-align: left">
                                        <i class="fa fa-user custom-icon"></i>
                                    </div>
                                </div>
                                <div class="ibox-content profile-content">
                                    <h2><strong>Usuario 1</strong></h2>
                                    <p><i class="fa fa-address-card"></i> fulanito perez</p>
                                    <p><i class="fa fa-envelope"></i> usuario1@gmail.com</p>
                                    <p><i class="fa fa-phone"></i> 76621547</p>
                                    <p><i class="fa fa-coffee"></i> Administrador general</p>
                                    <!-- Pedidos registrados -->
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-4">
                                                <i class="fa fa-list-alt fa-5x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Pedidos registrados</span>
                                                <h2 class="font-bold">15</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pedidos terminados -->
                                    <div class="widget style1 lazur-bg">
                                        <div class="row vertical-align">
                                            <div class="col-4">
                                                <i class="fa fa-check-circle fa-5x"></i>
                                            </div>
                                            <div class="col-8 text-right">
                                                <span>Pedidos terminados</span>
                                                <h2 class="font-bold">7</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Actividades</h5>
                            </div>
                            <div class="ibox-content">
                                <div>
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <thead>
                                                <tr>
                                                    <th><i class="fa fa-edit"></i> Acción</th>
                                                    <th><i class="fa fa-calendar"></i> Fecha y hora</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>Sesion Iniciada</td>
                                                <td>5/05/2023 - 16:30</td>
                                            </tr>
                                            <tr>
                                                <td>Registro de pedido</td>
                                                <td>5/05/2023 - 16:30</td>
                                            </tr>
                                            <tr>
                                                <td>registro de medidas</td>
                                                <td>5/05/2023 - 16:30</td>
                                            </tr>
                                            <tr>
                                                <td>registro de vestimenta</td>
                                                <td>5/05/2023 - 16:30</td>
                                            </tr>
                                            <tr>
                                                <td>cerrar sesion</td>
                                                <td>5/05/2023 - 16:30</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-block m">
                                        <i class="fa fa-arrow-down"></i> Ver mas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')

        <script>

        </script>
        <style>
            .custom-icon {
                font-size: 10em;
            }
        </style>
        @endpush
</x-app>