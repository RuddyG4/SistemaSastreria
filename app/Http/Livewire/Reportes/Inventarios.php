<?php

namespace App\Http\Livewire\Reportes;

use Livewire\Component;
use App\Models\inventario\Material;
use App\Models\inventario\Inventario as MInventario;

class Inventarios extends Component
{
    public function render()
    {
        
        return view('livewire.reportes.inventarios',[
            'materiales' => Material::all(),
            'datos' => MInventario::all()
        ]);
    }
}
