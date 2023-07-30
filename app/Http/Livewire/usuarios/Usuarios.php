<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\Persona;
use App\Models\usuarios\Rol;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;
    public $busqueda;
    public $nombre, $apellido, $ci, $username, $email, $id_rol, $password, $id_persona;
    public User $authenticatedUser;

    protected $listeners = ['darBaja'];

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'ci' => 'required|numeric|unique:persona',
        'username' => 'required|string|unique:usuario|max:30',
        'email' => 'required|email|unique:usuario|max:50',
        'id_rol' => 'required|numeric',
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
        'username.max' => 'El nombre de usuario no debe tener más de 30 carácteres',
        'email.required' => 'Debe ingresar un correo electronico.',
        'email.email' => 'Debe ingresar un formato de correo válido.',
        'email.unique' => 'El correo ingresado ya existe.',
        'email.max' => 'El correo no debe tener más de 50 carácteres',
        'id_rol.required' => 'Debe seleccionar un rol.',
        'password.required' => 'Debe ingresar una contraseña.',
        'password.min' => 'La contraseña debe tener al menos 8 carácteres.',
    ];

    public function render()
    {
        return view(
            'livewire.usuarios.usuarios',
            [
                'usuarios' => User::where('activo', 0)->where(function ($query) {
                    $query->whereHas('persona', function ($query) {
                        $query->where('nombre', 'like', "%$this->busqueda%")
                            ->orWhere('apellido', 'like', "%$this->busqueda%");
                    })->orWhere('username', 'like', "%$this->busqueda%")
                        ->orWhere('email', 'like', "%$this->busqueda%");
                })->with(['persona', 'rol'])->paginate(12)
                /* ->filter(function ($usuario) {  // YA NO USO FILTER PORQUE ES MENOS EFECTIVO
                        return $usuario->activo == 0;
                    }) */,
                'roles' => Rol::all(),
                'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                    $query->where('id', $this->authenticatedUser->rol->id);
                })->where(function ($query) {
                    $query->where('nombre', 'LIKE', "usuario.%")
                        ->orWhere('nombre', 'like', 'bitacora.%');
                })->pluck('nombre')->toArray(),
            ]
        );
    }

    public function mount()
    {
        $this->authenticatedUser = Auth::user();
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
                'username' => 'required|string|max:30',
                'email' => 'required|email|max:50',
                'id_rol' => 'required|numeric',
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
        $datos = $this->validate();
        $persona = Persona::create($datos);
        $user = new User($datos);
        $persona->usuario()->save($user);
        $this->authenticatedUser->generarBitacora("Usuario creado, id: $persona->id");
        $this->emit('usuarioCreado');
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
        $this->id_rol = $persona->usuario->id_rol;
        $this->id_persona = $id;
    }

    public function update()
    {
        $datos = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'ci' => 'required|numeric',
            'username' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'id_rol' => 'required|numeric',
        ]);
        $persona = Persona::find($this->id_persona);
        $persona->update($datos);
        $persona->usuario->update($datos);
        $this->authenticatedUser->generarBitacora("Usuario modificado, id: $persona->id");
        $this->emit('usuarioActualizado');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function darBaja(User $usuario)
    {
        $usuario->update(['activo' => 1]);
        $this->authenticatedUser->generarBitacora("Usuario deshabilitado, id: $usuario->id");
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'apellido', 'ci', 'username', 'email', 'id_rol', 'password', 'id_persona']);
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
