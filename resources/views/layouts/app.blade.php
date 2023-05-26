<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ? $title.' |': '' }} Sastreria Maya</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/1d8ccf6f72.js" crossorigin="anonymous"></script>
    <!-- <link href="{{ asset('css/font-awesome/font-awesome.css') }}" rel="stylesheet" /> -->

    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />

    <!-- Gritter -->
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    @livewireStyles
</head>

<body>

    <div id="wrapper">
        <!-- Menú lateral -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">Jorge11</span>
                                <span class="text-muted text-xs block">Administrador<b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li>
                                    <a class="dropdown-item" href="profile.html">Perfil</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="login.html">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">IN+</div>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-th-large"></i>
                            <span class="nav-label">INICIO</span></a>
                    </li>
                    <li class="active">
                        <a href="index.html"><i class="fa fa-user-o"></i>
                            <span class="nav-label">USUARIO</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active">
                                <a href="{{ url('/dashboard/usuarios') }}">Administrar Usuario</a>
                            </li>
                            <li><a href="{{ url('/dashboard/roles') }}">Administrar Roles</a></li>
                            <li>
                                <a href="{{ url('/dashboard/funcionalidades') }}">Administrar Funcionalidad</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-wrench"></i>
                            <span class="nav-label">SERVICIO</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="{{url('/dashboard/clientes')}}">Clientes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book"></i>
                            <span class="nav-label">INVENTARIO</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="">PARTE 1</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido de pagina -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i>
                        </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Busca algo..." class="form-control" name="top-search" id="top-search" />
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li style="padding: 20px">
                            <span class="m-r-sm text-muted welcome-message">Bienvenido - Sastreria Maya.</span>
                        </li>
                        <li>
                            <a href="{{url('logout')}}">
                                <i class="fa fa-sign-out"></i> Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Contenido principal -->
            {{ $slot }}

            <!-- Footer -->
            <div class="footer">
                <div><strong>Copyright</strong> Sastreria Maya &copy; 2023</div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{ asset('js\jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
  <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}"></script>
  <script src="{{ asset('js/demo/peity-demo.js') }}"></script>

  <!-- Custom and plugin javascript -->
  <script src="{{ asset('js/inspinia.js') }}"></script>
  <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

  <!-- jQuery UI -->
  <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  <!-- GITTER -->
  <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}"></script>

  <!-- Sparkline -->
  <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

  <!-- Sparkline demo data  -->
  <script src="{{ asset('js/demo/sparkline-demo.js') }}"></script>

  <!-- ChartJS-->
  <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}"></script>

  <!-- Toastr -->
  <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>

    <!-- Livewire y js de modales -->
    @livewireScripts
    @stack('scripts')

    <!-- Sweet alert -->
    <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(".deleted").click(function() {
            swal({
                    title: "¿Estas Seguro?",
                    text: "Eliminar Usuario",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "¡Sí, bórralo!",
                    cancelButtonText: "¡No, cancela por favor!",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal("¡Eliminado!", "El usuario ha sido eliminado.", "success");
                    } else {
                        swal("Cancelado", "Usuario no eliminado", "error");
                    }
                }
            );
        });
    </script>


</body>

</html>