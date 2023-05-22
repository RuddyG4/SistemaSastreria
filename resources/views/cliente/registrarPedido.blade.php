<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bienvenida | Sastreria Maya</title>
        <link rel="shortcut icon" href="{{ asset('images/logo-icon.jpg') }}">

    </head>
    <body>
        <h1>registro</h1>
        <form action="{{ url('/dashboard/pedido')}}" method="POST">
            @csrf
        
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                @error('nombre') {{ $message}} @enderror
            </div>
        
            <div>
                <label for="apellido">Apellido :</label>
                <input type="text" name="apellido" id="apellido" required>
                @error('apellido') {{ $message}} @enderror
            </div>
        
            <div>
                <label for="C.I.">C.I.:</label>
                <input type="text" name="ci" id="ci" required>
                @error('ci') {{ $message}} @enderror
            </div>

            <div>
                <label for="direccion">direccion:</label>
                <input type="text" name="direccion" id="direccion" required>
                @error('direccion') {{ $message}} @enderror
            </div>

            <div>
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" id="telefono" required>
                @error('telefono') {{ $message}} @enderror
            </div>
        
           nombre, apellido, ci, direccion, telefono, fecha-recepcion=now, estado=0 
            <button type="submit">Registrar</button>
        </form>
    </body>
</html>