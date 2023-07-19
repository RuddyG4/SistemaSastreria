<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Cliente;
use App\Models\servicios\Pedido;
use App\Models\servicios\UnidadVestimenta;
use Livewire\Component;

class VestimentaPedido extends Component
{
    public $vestimentas;
    public Pedido $pedido;

    public function render()
    {
        return view('livewire.servicios.pedidos.vestimenta-pedido', [
            'propietarios' => Cliente::join('persona', 'cliente.id', '=', 'persona.id')
                ->whereHas('unidadesVestimenta', function ($query) {
                    $query->where('id_pedido', $this->pedido->id);
                })
                ->select('persona.nombre', 'persona.id', 'persona.apellido')
                ->withCount(['unidadesVestimenta' => function ($query) {
                    $query->where('id_pedido', $this->pedido->id);
                }, 'unidadesVestimenta as vestimentas_terminadas_count' => function ($query) {
                    $query->where('id_pedido', $this->pedido->id)
                        ->where('estado', 1);
                },])
                ->get(),
        ]);
    }

    public function mount()
    {
        $this->vestimentas = [];
    }

    public function verVestimentas($id_propietario)
    {
        $this->vestimentas = UnidadVestimenta::where('id_cliente', $id_propietario)
            ->where('id_pedido', $this->pedido->id)
            ->with('vestimenta')
            ->get();
    }

    public function marcarComoTerminado(UnidadVestimenta $vestimenta)
    {
        $vestimenta->estado = 1;
        $vestimenta->save();
        $this->vestimentas = UnidadVestimenta::where('id_cliente', $vestimenta->id_cliente)
            ->where('id_pedido', $this->pedido->id)
            ->with('vestimenta')
            ->get();
    }

    public function cancelar()
    {
        // 
    }
}
