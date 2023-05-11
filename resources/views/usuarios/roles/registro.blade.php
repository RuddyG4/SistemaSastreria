<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>

    </head>
    <body >

        <form action="{{route('registro.submit')}}" method="POST">
            @csrf
        
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
        
            <div>
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" required>
            </div>
        
            <div>
                <label for="dni">DNI:</label>
                <input type="text" name="ci" id="ci" required>
            </div>
        
            <div>
                <label for="nick">Nick:</label>
                <input type="text" name="usuario" id="usuario" required>
            </div>
        
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
        
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
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
