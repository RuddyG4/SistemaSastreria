<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ asset('css/register.css') }}"/>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>registro</title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> --}}
    </body>
    </head>
    <body >

            <div class="left-column">
              <img src="ruta/a/la/imagen.jpg" alt="Imagen">
            </div>

            <div class="right-column">
              
                <div class="container">
                    <form action="{{route('registro.submit')}}" method="POST" class="">
                        @csrf
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="nombre"type="text" name="nombre" id="nombre" required>
                            <label class="form__label" for="nombre">Nombre</label>                         
                        </div>
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="apellido" type="text" name="apellido" id="apellido" required>
                            <label class="form__label" for="apellido">Apellido</label>
                        </div>
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="ci"type="text" name="ci" id="ci" required>
                            <label class="form__label" for="C.I.">C.I.</label>
                        </div>
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="username"type="text" name="username" id="username" required>
                            <label class="form__label" for="nick">Nick</label>
                            
                        </div>
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="email"type="email" name="email" id="email" required>
                            <label class="form__label" for="email">Correo</label>
                            
                        </div>
                    
                        <div class="form__group field">
                            <input class="form__field" placeholder="password" type="password" name="password" id="password" required>
                            <label class="form__label" for="password">Contraseña</label>
                            
                        </div>
                        
                        <div class="form__group field">
                            <input class="form__field" placeholder="password_confirmation" type="password" name="password_confirmation" id="password_confirmation" required>
                            <label class="form__label" for="password_confirmation">Confirmar contraseña</label>
                            
                        </div>
                
                         <div class="form__group">
                            <select class="form__field" name="id_rol" id="id_rol" required>
                              <option value="" disabled selected>Rol</option>
                              <option value="1">Administrador general</option>
                              <option value="2">Administrador</option>
                              <option value="3">atencion al cliente</option>
                            </select>
                          </div>
                        <div class="form__group">
                            <button  class="button" type="submit">Registrar</button>
                        </div>
                        
                    </form>

                </div>
            </div>

    </body>
</html>
