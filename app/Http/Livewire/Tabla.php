<?php

namespace App\Http\Livewire;
use App\Models\usuarios\Rol;


use Livewire\Component;

class Tabla extends Component
{

    public $nombre;
    public $descripcion;
    public $idEdit;
    public $afuera = 45;
    public $show = false;
    public $showEdit = false;
    public $showDelete = false;
    public $showNew = false;
    public $contenido = '';

    
    // cierra el model
    public function showoff()
    {
        $this->show = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->showNew = false;
    }

    // funciones para crear
    public function showModel()
    {
        $this->nombre =  '';
        $this->descripcion = '';
        $this->contenido = 'Crear Rol';
        $this->show = true;
        $this->showNew = true;
    }
    public function savedato()
    {

        $rol = new Rol;
        $rol->nombre =  $this->nombre;
        $rol->descripcion =  $this->descripcion;
        $rol->save();

        $this->show = false;
        $this->showNew = false;
        $this->clearForm();
    }


    // funciones para editar
    public function editar($id)
    {

        $rol = Rol::findOrFail($id);
        $this->nombre = $rol->nombre;
        $this->descripcion = $rol->descripcion;
        $this->idEdit = $id;
        $this->contenido = "Editar Rol";
        $this->show = true;
        $this->showEdit = true;
    }

    public function saveEdit()
    {
        $rol = Rol::find($this->idEdit);
        $rol->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        $this->show = false;
        $this->showEdit = false;
        $this->clearForm();
    }

    // funciones para eliminar
    public function deleteRol($id)
    {   $this->idEdit = $id;
        $this->contenido = 'Elimiar Rol';
        $this->show = true;
        $this->showDelete= true;
    }

    public function Delete()
    {
        $rol = Rol::find($this->idEdit);
            if ($rol) {
            $rol->delete();
        }
        $this->show = false;
        $this->showDelete = false;
    }

    public function clearForm()
    {
        $this->nombre='';
        $this->descripcion='';
    }
    public function render()
    {
        $roles = Rol::paginate(10);
        return view('livewire.tabla',compact('roles'));
    }


}
