<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenida | Sastreria Maya</title>
        <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">

    </head>
    <body>
        <article>
            <button> <a href="{{url('logout')}}" >logout</a> </button>
        </article>
        <h3>usuario: {{$user->username}} </h3> 
        <h3>email: {{$user->email}} </h3> 

        @if ($user->id_rol === 1)
            <h3>rol: administrador principal </h3> 
        @elseif ($user->id_rol === 2)
            <h3>rol: administrador</h3> 
        @else
            <h3>rol: atencion al cliente </h3> 
        @endif

        @if ($user->id_rol === 1)
            <button> <a href="{{url('/dashboard/usuarios/create')}}" >registrar usuario</a> </button>
            <button> <a href="{{url('/dashboard/pedido/create')}}" >nuevo pedido</a> </button>         
        @else
            <button> <a href="{{url('/dashboard/pedido/create')}}" >nuevo pedido</a> </button>
        @endif
        
    </body>
</html>