<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Pedido;
use Livewire\Component;

class CrearPedido extends Component
{
    public Pedido $pedido;
    
    public function render()
    {
        return view('livewire.servicios.pedidos.crear-pedido');
    }

    public function mount()
    {
        $this->pedido = new Pedido();
    }

    
}
