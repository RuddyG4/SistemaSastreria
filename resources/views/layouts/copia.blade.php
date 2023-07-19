<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Name - @yield('title')</title>
    <!-- Logo -->
    <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">

    <!-- Iconos -->
    <link href="{{ asset('css/font-awesome/font-awesome.css') }}" rel="stylesheet" />

    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- Gritter -->
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    @livewireStyles
</head>

<body>

    <?php

    use App\Models\usuarios\Funcionalidad;
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $permisos = Funcionalidad::whereHas('roles', function ($query) use($user) {
        $query->where('id', $user->rol->id);
    })->where(function ($query) {
        $query->where('nombre', 'LIKE', "adm.%")
            ->orWhere('nombre', 'like', "%.lista");
    })->pluck('nombre')->toArray();
    ?>
    <div id="wrapper">
        <!-- Menú lateral -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="block m-t-xs font-bold">{{$user->persona->nombre}}</span>
                                <span class="text-muted text-xs block">{{$user->rol->nombre}}<b></b></span>
                            </a>
                        </div>
                    </li>
                    <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-th-large"></i>
                            <span class="nav-label">INICIO</span></a>
                    </li>
                    @if(in_array('adm.usuario', $permisos))
                    <li class="{{ Request::is('dashboard/adm_usuarios*') ? 'active' : '' }}">
                        <a href=""><i class="fa fa-user-o"></i>
                            <span class="nav-label">Adm. de Usuarios</span>
                            <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            @if(in_array('usuario.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_usuarios/usuarios*') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard/adm_usuarios/usuarios') }}">Usuarios</a>
                            </li>
                            @endif
                            @if(in_array('rol.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_usuarios/roles*') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard/adm_usuarios/roles') }}">Roles</a>
                            </li>
                            @endif
                            @if(in_array('funcionalidad.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_usuarios/funcionalidades*') ? 'active' : '' }}">
                                <a href="{{ url('/dashboard/adm_usuarios/funcionalidades') }}">Funcionalidades</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(in_array('adm.servicio', $permisos))
                    <li class="{{ Request::is('dashboard/adm_servicios/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-wrench"></i>
                            <span class="nav-label">Adm. de Servicios</span><span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            @if(in_array('cliente.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_servicios/clientes*') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_servicios/clientes')}}">Clientes</a>
                            </li>
                            @endif
                            @if(in_array('pedido.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_servicios/pedidos*') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_servicios/pedidos')}}">Pedidos</a>
                            </li>
                            @endif
                            @if(in_array('vestimenta.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_servicios/vestimentas*') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_servicios/vestimentas')}}">Vestimentas</a>
                            </li>
                            @endif
                            @if(in_array('medida.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_servicios/medidas*') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_servicios/medidas')}}">Medidas</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(in_array('adm.inventario', $permisos))
                    <li class="{{ Request::is('dashboard/adm_inventario/*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-book"></i>
                            <span class="nav-label">Adm. de Inventario</span><span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            @if(in_array('inventario.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_inventario/inventario') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_inventario/inventario')}}">Inventario</a>
                            </li>
                            @endif
                            @if(in_array('almacen.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_inventario/almacenes') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_inventario/almacenes')}}">Almacenes</a>
                            </li>
                            @endif
                            @if(in_array('nota_ingreso.lista', $permisos) || in_array('nota_salida.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_inventario/notas') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_inventario/notas')}}">Notas ingreso/salida</a>
                            </li>
                            @endif
                            @if(in_array('material.lista', $permisos))
                            <li class="{{ Request::is('dashboard/adm_inventario/materiales') ? 'active' : '' }}">
                                <a href="{{url('/dashboard/adm_inventario/materiales')}}">Materiales</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>

        <!-- Contenido de pagina -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header d-flex align-items-center">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="p-2">
                            <span class="m-r-sm text-muted welcome-message"><b>Bienvenido - Sastreria Maya.</b></span>
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
            <div class="wrapper wrapper-content">
                @yield('content')
            </div>

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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>

    <!-- Livewire y js de modales -->
    @livewireScripts

    <!-- Sweet alert - CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="{{ asset('js/plugins/sweetalert/sweetalert.min.js') }}"></script> -->
    @stack('scripts')

</body>

</html>