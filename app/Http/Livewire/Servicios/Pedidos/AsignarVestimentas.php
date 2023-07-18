<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Cliente;
use App\Models\servicios\Pedido;
use App\Models\servicios\Vestimenta;
use Livewire\Component;

class AsignarVestimentas extends Component
{
    public Pedido $pedido;
    public $id_cliente;

    public function render()
    {
        return view('livewire.servicios.pedidos.asignar-vestimentas', [
            'clientes' => Cliente::all(),
            'vestimentas' => Vestimenta::whereHas('detalles', function ($query) {
                $query->where('id_pedido', $this->pedido->id);
            })
            ->withCount(['unidadesVestimenta' => function ($query) {
                $query->where('id_pedido', $this->pedido->id);
            },])
            ->get(),
        ]);
    }

    public function mount(Pedido $id)
    {
        $this->pedido = $id;
    }

    public function asignarVestimenta()
    {
    }
}
