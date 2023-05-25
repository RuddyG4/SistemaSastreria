<?php

namespace App\Http\Livewire\Servicios;

use App\Models\servicios\Cliente;
use App\Models\usuarios\Persona;
use Livewire\Component;

class Clientes extends Component
{
    public $busqueda;
    
    public function render()
    {
        return view(
            'livewire.servicios.clientes',
            [
                'personas' => Persona::Where('nombre', 'LIKE', "%$this->busqueda%")
                    ->orWhere('apellido', 'LIKE', "%$this->busqueda%")
                    ->orWhere('ci', 'LIKE', "%$this->busqueda%")->get(),
            ]
        );
    }
}
