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
        'nombre' => 'required|unique:rol|max:29|min:1',
        'descripcion' => 'required|max:99|min:1',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'descripcion.required' => 'La descripcion es obligatoria',
        'nombre.unique' => 'El nombre ya existe',
        'nombre.max' => 'El nombre es muy largo',
        'descripcion.max' => 'La descripcion es muy larga',
        'nombre.min' => 'El nombre es muy corto',
        'descripcion.min' => 'La descripcion es muy corta',
    ];


    public function store()
    {
        $this->validate();
        if (!(count($this->rolPermisos) > 0)){
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
        foreach($permisos as $per){
            $rolesRol[] = $per->id_funcionalidad;
        }
        $this->rolPermisos = Funcionalidad::whereIn('id',$rolesRol)->pluck('nombre');
    }   
    public function delete()
    {
        $rol = Rol::find($this->idRol);
        if ($rol) {
            $rol->funcionalidades()->detach();
            $rol->delete($this->idRol);
        }
        // $this->afuera='elimino';

        $this->cerrar();
        // $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->afuera='cerro';

    }
    public function edit($id)
    {
        $this->idRol = $id;
        $this->loadRol();
        $rol = Rol::findOrFail($id);
        $this->nombre = $rol->nombre;
        $permisos = $rol->funcionalidades()->select('permiso_rol.*')->get();
        foreach($permisos as $per){
            $this->rolPermisos [] = $per->id_funcionalidad;
        }
    }
    public function update()
    {   $this->afuera = 'entro';
        $rol = Rol::find($this->idRol);
        if ($rol) {            
            $rol->funcionalidades()->sync($this->rolPermisos);
            $this->afuera = 'actulizao';
        }else{
            $this->afuera = 'fallo';
        }

        
        $this->cerrar();
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
    }
    public function erase()
    {
        $this->reset(['nombre', 'descripcion','rolPermisos']);
    }
    public function render()
    {
        return view('livewire..usuarios.roles',[
            'roles' => Rol::get()
        ]);
    }
}
