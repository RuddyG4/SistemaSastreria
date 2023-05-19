<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function show()
    {
        return view('usuarios.login');
    }

    public function login(LoginRequest $request)
    {

        $credentials = $request->getCredentials();
        if (!Auth::validate($credentials)) {
            return redirect('login')->withErrors(
                ['error'=>'El nombre de usuario o contraseña son incorrectos, verifique e intente nuevamente']);
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials); // Recupera la instancia User perteneciente a $credentials.
        Auth::login($user);
        return redirect()->intended('dashboard');

        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
