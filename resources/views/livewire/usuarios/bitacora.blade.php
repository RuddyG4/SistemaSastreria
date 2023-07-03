<x-slot:title>
    Bitacora
    </x-slot>
    <div>
        <div class="ibox">
            <div class="ibox-title">
                <h1><strong>Bitacora</strong></h1>
            </div>
            <div class="wrapper wrapper-content  animated fadeInRight">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h2>Actividad de usuarios en el sistema :</h2>
                                <div class="clients-list">
                                    <!-- Tabla de paginacion -->
                                    <ul class="nav nav-tabs">
                                        <li>
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-1"><i class="fa fa-file-text fa-2x"></i> Dia en Curso</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2"><i class="fa fa-folder fa-2x"></i> Esta semana</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3"><i class="fa fa-book fa-2x"></i> Todo</a>
                                        </li>
                                    </ul>
                                    <!-- Contenido de la tabla -->
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <div class="full-height-scroll">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th><i class="fa fa-hashtag"> ID</th>
                                                                    <th><i class="fa fa-user-o"></i> Usuario</th>
                                                                    <th><i class="fa fa-edit"></i> Acción</th>
                                                                    <th><i class="fa fa-calendar"></i> Fecha y hora</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach($bitacorasHoy as $bitacora)
                                                            <tr>
                                                                <td>{{ $bitacora->id }}</td>
                                                                <td><a href="#Usuario_2" class="client-link">{{ $bitacora->usuario->username}}</td>
                                                                <td>{{ $bitacora->accion_realizada}}</td>
                                                                <td>{{ $bitacora->fecha_hora}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-2" class="tab-pane">
                                            <div class="full-height-scroll">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th><i class="fa fa-hashtag"> ID</th>
                                                                    <th><i class="fa fa-user-o"></i> Usuario</th>
                                                                    <th><i class="fa fa-edit"></i> Acción</th>
                                                                    <th><i class="fa fa-calendar"></i> Fecha y hora</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach($bitacorasSemana as $bitacora)
                                                            <tr>
                                                                <td>{{ $bitacora->id }}</td>
                                                                <td><a href="#Usuario_2" class="client-link">{{ $bitacora->usuario->username}}</td>
                                                                <td>{{ $bitacora->accion_realizada}}</td>
                                                                <td>{{ $bitacora->fecha_hora}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="tab-3" class="tab-pane">
                                            <div class="full-height-scroll">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover">
                                                        <tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th><i class="fa fa-hashtag"> ID</th>
                                                                    <th><i class="fa fa-user-o"></i> Usuario</th>
                                                                    <th><i class="fa fa-edit"></i> Acción</th>
                                                                    <th><i class="fa fa-calendar"></i> Fecha y hora</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach($bitacoras as $bitacora)
                                                            <tr>
                                                                <td>{{ $bitacora->id }}</td>
                                                                <td><a href="#Usuario_2" class="client-link">{{ $bitacora->usuario->username}}</td>
                                                                <td>{{ $bitacora->accion_realizada}}</td>
                                                                <td>{{ $bitacora->fecha_hora}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end contenido de la  tabla -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Segunda Tabla de detalles -->
                    <div class="col-sm-4">
                        <div class="ibox">
                            <div class="ibox-content">
                                <div class="tab-content">
                                    <!-- ------------------------------------ -->
                                    @if($usuario != null)
                                    <div id="Usuario_1" class="tab-pane active">
                                        <div class="row m-b-lg">
                                            <div class="col-lg-4 text-center">
                                                <h2>Usuario 1</h2>
                                                <div class="m-b-sm">
                                                    <i class="fa fa-user fa-5x"></i>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <strong> Descripcion de usuario </strong>
                                                <p>
                                                    El usuario es un chupapinga que tiene como rol
                                                    chuparpingas :v
                                                </p>
                                                <button type="button" class="btn btn-primary btn-sm btn-block">
                                                    <i class="fa fa-edit"></i> Editar su rol o ver su
                                                    bitacora
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <i class="fa fa-info-circle"></i> Funcionalidades
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group clear-list">
                                                        <li class="list-group-item fist-item">Editar</li>
                                                        <li class="list-group-item">Eliminar</li>
                                                        <li class="list-group-item">Crear</li>
                                                        <li class="list-group-item">etc..</li>
                                                        <li class="list-group-item">etc..</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <strong>Nota</strong>
                                            <p>No hay utilidad a la nota :v</p>
                                        </div>
                                    </div>
                                    @else
                                    <div>
                                        Seleccione un usuario
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    <script>
        $(document).ready(function() {
            $(document.body).on("click", ".client-link", function(e) {
                e.preventDefault();
                $(".selected .tab-pane").removeClass("active");
                $($(this).attr("href")).addClass("active");
            });
        });
    </script>

    @endpush