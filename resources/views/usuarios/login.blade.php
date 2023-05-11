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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
        
            <div>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
        
            <div>
                <button type="submit">Iniciar sesión</button>
            </div>
        </form>
        
        
    </body>
</html>
