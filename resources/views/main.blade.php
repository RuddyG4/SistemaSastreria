<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenida | Sastreria Maya</title>
        <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">

        <link rel="stylesheet" href="{{ asset('css/') }}">


    </head>
    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Sastreria Maya
              </a>
                    <div class="dropdown" class="d-flex">
                        <a class="btn  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                          cris12
                        </a>
                      
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>  
        </nav>

        <button type="button" class="btn btn-primary">
          <i class="fa-pencil" style="backgroundcolor: red"></i> Botón con Icono
        </button>
        
        
        {{-- <div class="container-fluid">
            <div class="row">
              <div class="col-md-2 bg-light overflow-auto">
                <!-- Barra lateral -->
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Usuario</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Rol</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Persona</a>
                  </li>
                </ul>
              </div>
              <div class="col-md-10">
                <!-- Contenido principal vacío -->
                <h1>nuevo</h1>
              </div>
            </div>
          </div> --}}
          <div class="container-fluid ">
          <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
              <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                  Usuarios
                </a>
              </li>
              <li>
                <a href="#" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                  Roles
                </a>
              </li>
              <li>
                <a href="#" class="nav-link link-dark">
                  <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                  Funciones
                </a>
              </li>
              

            </ul>
            <hr>

          </div>

          <div class="col-md-10">
            <!-- Contenido principal vacío -->
            <h1>nuevo</h1>
          </div>

          </div>
        



    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    </body>
</html>