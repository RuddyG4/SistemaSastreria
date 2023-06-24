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

    /**
     * Crea un nuevo rol
     * @return void
      */
    public function store()
    {
        if (!(count($this->rolPermisos) > 0)) {
            $this->addError('permisos', 'Debe seleccionar al menos 1 rol');
        }
        $rol = Rol::create($this->validate());
        Auth::user()->generarBitacora("Rol creado, id: $rol->id");
        $rol->funcionalidades()->attach($this->rolPermisos);

        $this->cerrar();
    }

    /**
     * Carga un modal para ver los permisos que tiene un determinado rol
     * @param Model $rol
     * @return void
     */
    public function view(Rol $rol)
    {
        $this->nombre = $rol->nombre;
        $this->rolPermisos = $rol->funcionalidades->pluck('nombre');
    }
    public function delete()
    {
        $rol = Rol::find($this->idRol);
        if ($rol) {
            $rol->funcionalidades()->detach();
            $rol->delete($this->idRol);
        }
        Auth::user()->generarBitacora("Rol eliminado, id: $rol->id");
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
        $datos = $this->validate([
            'nombre' => 'required|max:30',
            'descripcion' => 'required|max:99',
        ]);
        $rol = Rol::find($this->idRol);
        if ($rol) {
            $rol->funcionalidades()->sync($this->rolPermisos);
        }
        $rol->update($datos);
        Auth::user()->generarBitacora("Rol modificado, id: $rol->id");
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
