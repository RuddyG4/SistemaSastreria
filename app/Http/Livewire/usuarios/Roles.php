<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Rol;
use App\Models\usuarios\Funcionalidad;
use Livewire\Component;

class Roles extends Component
{

    // carga las lista de los permisos que hay en la BD
    public $funcList = [];
    // lista que cambia segun el id del rol
    public $rolPermisos = [];

    public $nombre, $descripcion, $idRol, $afuera;

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

    public function render()
    {
        return view('livewire..usuarios.roles', [
            'roles' => Rol::get()
        ]);
    }

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
        if ($this->rolPermisos == null) {
            $this->addError('permisos', 'Tiene que seleccionar al menos 1 rol');
        }else{
            $rol = Rol::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion
            ]);
            $rol->funcionalidades()->attach($this->rolPermisos);
            $this->dispatchBrowserEvent('cerrar-modal-crear');
        }
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
        $this->erase();
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
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
        $rol->nombre = $this->nombre;
        $rol->descripcion = $this->descripcion;
        if ($rol) {
            $rol->funcionalidades()->sync($this->rolPermisos);
            $rol->push();
        } 
        $this->dispatchBrowserEvent('cerrar-modal-editar');
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
