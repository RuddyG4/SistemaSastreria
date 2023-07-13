<x-app>
    <x-slot:title>
        Bienvenida
        </x-slot>
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-10 p-xs">
                    <h1 class="text-primary display-1 fw-bold" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 3rem;">
                        <span style="background-color: #007BFF; padding: 0 10px; border-radius: 10px; color: #FFF;">SISTEMA DE ADMINISTRACION DE</span><br>
                        <span style="background-color: #6C757D; padding: 0 10px; border-radius: 10px; color: #FFF; font-size: 4rem;">"SASTRERIA MAYA"</span>
                    </h1>
                </div>
                <div class="col-lg-2 p-xs d-flex align-items-center justify-content-end">
                    <img src="{{ asset('images/puntada.png') }}" alt="Logo" style="width: 230px; height: auto; margin-left: 50px;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget style1 red-bg py-2 px-5">
                        <div class="row">
                            <div class="col-4 text-center">
                                <i class="fa fa-tag fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Pedidos totales</span>
                                <h2 class="font-bold">100</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 yellow-bg py-2 px-5">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-male fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span>Pedidos Pendientes </span>
                                <h2 class="font-bold">todos</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 navy-bg py-2 px-5">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Pedidos terminados </span>
                                <h2 class="font-bold">ninguno</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="widget style1 blue-bg py-2 px-5">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-female fa-4x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> Pedidos cancelados </span>
                                <h2 class="font-bold">ninguno</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-lg-5">
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria1.jpg') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria2.jpg') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria3.jpg') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria4.jpg') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria5.jpg') }}" class="d-block w-100">
                            </div>
                            <div class="carousel-item" data-bs-interval="3000">
                                <img src="{{ asset('images/sastreria6.jpg') }}" class="d-block w-100">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 style="color: #007BFF; font-weight: bold;">RESEÑA</h2>
                    <p class="text-justify" style="font-size: 0.8rem; color: #000000; font-weight: bold;">
                        La Sastrería “Maya” es un negocio privado dedicado a la confección de trajes para ocasiones especiales, especialmente en el ámbito de trajes para promociones de colegios. El propietario, Remberto Choque Mamani, inició su negocio en el año 2010 con la finalidad de tener un ingreso extra que provenga de su propio esfuerzo. Anteriormente, había trabajado para otros y decidió que abrir su propio negocio era más favorable, ya que de esta forma podría obtener el 100% de las ganancias. Al inicio del negocio, se vendían alrededor de 30 productos al mes, siendo 15 productos en cada una de las dos campañas que se realizaban mensualmente.
                    </p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-success panel-pad">
                                <div class="row">
                                    <div class="col-lg-4 text-end">
                                        <i class="fa fa-map-marker" style="font-size: 90px; color: #333;"></i>
                                    </div>
                                    <div class="col-lg-8">
                                        <h2 class="text-start">Dirección</h2>
                                        <p class="text-start">C/Ballivian entre Oruro y Cobija #626</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-success panel-pad">
                                <div class="row">
                                    <div class="col-lg-4 text-end">
                                        <i class="fa fa-phone" style="font-size: 90px; color: #333;"></i>
                                    </div>
                                    <div class="col-lg-8">
                                        <h2 class="text-start">Teléfono</h2>
                                        <p class="text-start">+591 75632547</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success panel-pad">
                                <div class="row">
                                    <div class="col-lg-4 text-end">
                                        <i class="fa fa-clock-o" style="font-size: 90px; color: #333;"></i>
                                    </div>
                                    <div class="col-lg-8">
                                        <h2 class="text-start">Atención</h2>
                                        <p class="text-start">Lunes a viernes: 8:00 AM - 6:00 PM </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        @endpush
</x-app>