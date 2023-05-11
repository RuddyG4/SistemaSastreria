<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
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
        return view('usuarios.usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('usuarios.roles.registro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        echo $request->input('nombre');
        echo $request->input('apellido');
        echo $request->input('ci');
        echo $request->input('nick');
        echo $request->input('email');
        echo $request->input('password');
        echo $request->input('rol');

        $request->validate([
            'nombre'=>'required',
            'apellido'=>'required',
            'ci'=>'required|numeric|unique:persona',
            'usuario'=>'required|unique:usuario',
            'email'=>'required|unique:usuario',
            'password'=>'required|',
            'id_rol'=>'required|numeric|between:1,4',
        ]);

        $user = new Persona();
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->ci = $request->input('ci');

        $res = $user->save();
        if($res){
            echo 'guardado';
        } else{
            echo'error';
        }

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
