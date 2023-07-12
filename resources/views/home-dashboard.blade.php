<x-app>
    <x-slot:title>
        Bienvenida
        </x-slot>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="p-xs d-flex align-items-center">
                <div class="m-r-md">
                    <i class="fa fa-scissors text-info" style="font-size: 9em"></i>
                </div>
                <div>
                    <h1 class="text-danger"><strong>Sistema de Administracion de SATRERIA MAYA</strong></h1>
                    <h2>Bienvenid@ <b><strong> {{Auth::user()->username}}</strong></b></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content m-b-sm border-bottom">
                        <div class="p-xs">
                            <h1>hola mundo</h1>
                            <div class="col-lg-5">
                                <div class="ibox ">
                                    <div class="ibox-content">
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="1000">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block w-100" src="{{ asset('images/sastreria1.jpg') }}" alt="First slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/sastreria2.jpg') }}" alt="Second slide">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="{{ asset('images/sastreria3.jpg') }}" alt="Third slide">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
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