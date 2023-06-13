<?php

namespace App\Http\Livewire\Inventario;

use Livewire\Component;

class Inventario extends Component
{
    public $busqueda;
    
    public function render()
    {
        return view('livewire.inventario.inventario');
    }
}
