<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

    </head>
    <body >

        <form action="{{ url('/dashboard/usuarios')}}" method="POST">
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
                <label for="nick">nombre de usuario:</label>
                <input type="text" name="username" id="username" required>
                @error('username') {{ $message}} @enderror
            </div>
        
            <div>
                <label for="email">Correo :</label>
                <input type="email" name="email" id="email" required>
                @error('email') {{ $message}} @enderror
            </div>
        
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
                @error('password') {{ $message}} @enderror
            </div>
            
            <div>
                <label for="password_confirmation">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                @error('password_confirmation') {{ $message}} @enderror
            </div>
        
            <div>
                <label for="rol">Rol:</label>
                <select name="id_rol" id="id_rol" required>
                    <option value="1">Administrador general</option>
                    <option value="2">Administrador</option>
                    <option value="3">cliente</option>
                    <option value="4">atencion al cliente</option>
                </select>
            </div>
        
            <button type="submit">Registrar</button>
        </form>
        
    </body>
</html>
