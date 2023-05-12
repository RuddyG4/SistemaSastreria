<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\usuarios\User;

// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
        return view('usuarios.login');
    }

    public function store(Request $request)
    {
        // echo $request->input('email');
        // echo $request->input('password');

        // validar primero con JS en la view
        $request->validate([
            'email'=>'required|unique:usuario',
            'password'=>'required|'
        ]);
       
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // echo $credentials['email'];
        // echo $credentials['password'];
       
        if (Auth::attempt($credentials)){
            
            echo 'exito';
        } else{
            echo 'fallo';

        }

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
