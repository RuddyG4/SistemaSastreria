<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuarios.registro.registro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $persona = Persona::create($request->only('nombre', 'apellido', 'ci'));
        $user = new User($request->only('username', 'email', 'password', 'id_rol'));
        $persona->usuario()->save($user);
        return redirect('/dashboard/usuarios')->with('success_regist', 'Usuario registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
