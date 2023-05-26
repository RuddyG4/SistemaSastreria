<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Persona;
use App\Models\usuarios\Rol;
use App\Models\usuarios\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Usuarios extends Component
{
    public $busqueda;
    public $nombre, $apellido, $ci, $username, $email, $rol, $password, $id_persona;

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'ci' => 'required|numeric|unique:persona',
        'username' => 'required|string|unique:usuario',
        'email' => 'required|email|unique:usuario',
        'rol' => 'required|numeric',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'apellido.required' => 'El apellido es obligatorio',
        'ci.required' => 'El C.I. es obligatorio',
        'ci.numeric' => 'El C.I. solo debe contener números',
        'ci.unique' => 'El C.I. ingresado ya existe',
        'username.required' => 'Debe ingresar un nombre de usuario.',
        'username.unique' => 'El nombre de usuario ingresado ya existe.',
        'email.required' => 'Debe ingresar un correo electronico.',
        'email.email' => 'Debe ingresar un formato de correo válido.',
        'email.unique' => 'El correo ingresado ya existe.',
        'rol.required' => 'Debe seleccionar un rol.',
        'password.required' => 'Debe ingresar una contraseña.',
        'password.min' => 'La contraseña debe tener al menos 8 carácteres.',
    ];

    public function render()
    {
        return view(
            'livewire.usuarios.usuarios',
            [
                'usuarios' => User::whereHas('persona', function (Builder $query) {
                    $query->where('nombre', 'like', "%$this->busqueda%")
                        ->orWhere('apellido', 'like', "%$this->busqueda%");
                })->orWhere('username', 'like', "%$this->busqueda%")
                    ->orWhere('email', 'like', "%$this->busqueda%")->get()->filter(function ($usuario) {
                        return $usuario->activo == 0;
                    }),
                'roles' => Rol::all(),
            ]
        );
    }

    public function updated($propertyName)
    {
        if ($this->id_persona == null) {
            $this->validateOnly($propertyName);
        } else {
            $this->validateOnly($propertyName, [
                'nombre' => 'required',
                'apellido' => 'required',
                'ci' => 'required|numeric',
                'username' => 'required|string',
                'email' => 'required|email',
                'rol' => 'required|numeric',
                'password' => 'required|min:8',
            ]);
        }
    }

    public function cancelar()
    {
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate();
        $persona = Persona::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'ci' => $this->ci,
        ]);
        $user = new User([
            'username' => $this->username,
            'email' => $this->email,
            'id_rol' => $this->rol,
            'password' => $this->password,
        ]);
        $persona->usuario()->save($user);
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function editar($id)
    {
        $persona = Persona::find($id);
        $this->nombre = $persona->nombre;
        $this->apellido = $persona->apellido;
        $this->ci = $persona->ci;
        $this->username = $persona->usuario->username;
        $this->email = $persona->usuario->email;
        $this->rol = $persona->usuario->id_rol;
        $this->id_persona = $id;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'ci' => 'required|numeric',
            'username' => 'required|string',
            'email' => 'required|email',
            'rol' => 'required|numeric',
        ]);
        $persona = Persona::find($this->id_persona);
        $persona->nombre = $this->nombre;
        $persona->apellido = $this->apellido;
        $persona->ci = $this->ci;
        $persona->usuario->username = $this->username;
        $persona->usuario->email = $this->email;
        $persona->usuario->id_rol = $this->rol;
        $persona->push();
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function darBaja($id)
    {
        $user = User::find($id);
        $user->activo = 1;
        $user->save();
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'apellido', 'ci', 'username', 'email', 'rol', 'password', 'id_persona']);
    }
}
