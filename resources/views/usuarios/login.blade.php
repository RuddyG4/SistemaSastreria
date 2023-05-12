<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>login</title>

    </head>
    <body >

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
        
            <div>
                <label for="username">nombre de usuario o correo:</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
                @error('username')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>

        
            <div>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                @error('password')
            <span class="error">{{ $message }}</span>
               @enderror
            </div>
        
            <div>
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>
        
        
    </body>
</html>
