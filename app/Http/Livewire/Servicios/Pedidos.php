<?php

namespace App\Http\Livewire\Servicios;

use App\Models\servicios\Pedido;
use Livewire\Component;

class Pedidos extends Component
{
    public function render()
    {
        return view('livewire.servicios.pedidos', [
            'pedidos' => Pedido::with('cliente.persona')->paginate(10),
        ]);
    }
}
