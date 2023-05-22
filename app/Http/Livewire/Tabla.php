<?php

namespace App\Http\Livewire;
use App\Models\usuarios\Rol;
use Illuminate\Http\Request;

use Livewire\Component;

class Tabla extends Component
{

    public $titulo;
    public $descripcion;
    public $idEdit;
    public $afuera = 45;
    public $show = false;
    public function showModel($_id)
    {
        $this->idEdit = $_id;
        $this->show = true;

    }
    public function showoff()
    {

        $this->show = false;
    }
    
    public function savedato(){
        Rol::create([
            'nombre' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);
        $this->show = false;
        $this->titulo='';
        $this->descripcion='';
    }

    public function render()
    {
        $roles = Rol::paginate(10);
        return view('livewire.tabla',compact('roles'));
    }


}
