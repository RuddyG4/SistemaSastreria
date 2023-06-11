<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Rol;
use App\Models\usuarios\Funcionalidad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Roles extends Component
{

    // carga las lista de los permisos que hay en la BD
    public $funcList = [];
    // lista que cambia segun el id del rol
    public $rolPermisos = [];

    public $nombre, $descripcion, $idRol;

    public function render()
    {
        return view('livewire..usuarios.roles', [
            'roles' => Rol::get(),
            'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', Auth::user()->rol->id);
            })->where('nombre', 'LIKE', "rol.%")
                ->pluck('nombre')->toArray(),
        ]);
    }

    protected $rules = [
        'nombre' => 'required|unique:rol|max:30',
        'descripcion' => 'required|max:100',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'descripcion.required' => 'La descripcion es obligatoria',
        'nombre.unique' => 'El nombre ya existe',
        'nombre.max' => 'El nombre solo puede contener hasta 30 caracteres',
        'descripcion.max' => 'La descripcion solo puede contener hasta 100 caracteres',
    ];

    public function updated($propertyName)
    {
        if ($this->idRol == null) {
            $this->validateOnly($propertyName);
        } else {
            $this->validateOnly($propertyName, [
                'nombre' => 'required|max:30',
                'descripcion' => 'required|max:99',
            ]);
        }
    }

    public function store()
    {
        $this->validate();
        if (!(count($this->rolPermisos) > 0)) {
            $this->addError('permisos', 'Tiene que seleccionar al menos 1 rol');
        }

        $rol = Rol::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);
        $rol->funcionalidades()->attach($this->rolPermisos);

        $this->cerrar();
    }
    public function view($idRol)
    {
        $rol = Rol::findOrFail($idRol);
        $this->nombre = $rol->nombre;
        $permisos = $rol->funcionalidades()->select('permiso_rol.*')->get();
        foreach ($permisos as $per) {
            $rolesRol[] = $per->id_funcionalidad;
        }
        $this->rolPermisos = Funcionalidad::whereIn('id', $rolesRol)->pluck('nombre');
    }
    public function delete()
    {
        $rol = Rol::find($this->idRol);
        if ($rol) {
            $rol->funcionalidades()->detach();
            $rol->delete($this->idRol);
        }
        $this->cerrar();
        // $this->dispatchBrowserEvent('cerrar-modal-eliminar');
    }
    public function edit($id)
    {
        $this->idRol = $id;
        $this->loadRol();
        $rol = Rol::findOrFail($id);
        $this->nombre = $rol->nombre;
        $this->descripcion = $rol->descripcion;
        $permisos = $rol->funcionalidades()->select('permiso_rol.*')->get();
        foreach ($permisos as $per) {
            $this->rolPermisos[] = $per->id_funcionalidad;
        }
    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required|max:30',
            'descripcion' => 'required|max:99',
        ]);
        $rol = Rol::find($this->idRol);
        if ($rol) {
            $rol->funcionalidades()->sync($this->rolPermisos);
        }
        $rol->nombre = $this->nombre;
        $rol->descripcion = $this->descripcion;
        $rol->save();
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->erase();
    }



    // funciones axiliares
    public function loadRol()
    {
        $this->funcList = Funcionalidad::get();
    }
    public function cerrar()
    {
        $this->erase();
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-ver');
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
    }
    public function erase()
    {
        $this->reset(['nombre', 'descripcion', 'rolPermisos']);
    }
}
