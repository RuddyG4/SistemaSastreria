<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::paginate(10);
        return view('usuarios.usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuarios.registro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo $request->input('nombre');
        echo $request->input('apellido');
        echo $request->input('ci');
        echo $request->input('nick');
        echo $request->input('email');
        echo $request->input('password');
        echo $request->input('rol');

        // validar primero con JS en la view
        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'ci'=>'required|numeric|unique:persona',
            'usuario'=>'required|unique:usuario',
            'email'=>'required|unique:usuario',
            'password'=>'required|',
            'id_rol'=>'required|numeric|between:1,4',
        ]);

        // registro a la tabla persona
        $persona = new Persona();
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->ci = $request->input('ci');
        $persona->save();

        // recuperamos la id de la persona con su ci
        $idPersona = Persona::where('ci',$persona->ci)->value('id');

        // registro a la tabla usuario
        $usuario = new User();
        $usuario->id = $idPersona;
        $usuario->usuario = $request->input('usuario');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('password'));
        // $usuario->password = $request->input('password');
        $usuario->id_rol = $request->input('id_rol');
        $usuario->save();

        echo $persona;
        echo $usuario;

        echo 'fin';


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
