<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Cliente;
use App\Models\servicios\Pedido;
use App\Models\servicios\UnidadVestimenta;
use App\Models\servicios\Vestimenta;
use Livewire\Component;

class AsignarVestimentas extends Component
{
    public $pedido, $id_pedido;
    public $id_cliente, $id_vestimenta, $cantidad;

    protected $rules = [
        'id_cliente' => 'required',
        'id_vestimenta' => 'required',
        'cantidad' => 'required',
    ];

    public function render()
    {
        $this->pedido = Pedido::withCount('vestimentas')
            ->withSum('detalles', 'cantidad')
            ->find($this->id_pedido);
        return view('livewire.servicios.pedidos.asignar-vestimentas', [
            'clientes' => Cliente::all(),
            'vestimentas' => Vestimenta::whereHas('detalles', function ($query) {
                $query->where('id_pedido', $this->pedido->id);
            })
                ->with('detalles', function ($query) {
                    $query->where('id_pedido', $this->pedido->id);
                })
                ->withCount(['unidadesVestimenta' => function ($query) {
                    $query->where('id_pedido', $this->pedido->id);
                },])
                ->get(),
        ]);
    }

    public function asignarVestimenta()
    {
        $this->validate();
        for ($i = 0; $i < $this->cantidad; $i++) {
            UnidadVestimenta::create([
                'id_cliente' => $this->id_cliente,
                'id_vestimenta' => $this->id_vestimenta,
                'estado' => 0,
                'fecha_cambio' => null,
                'id_pedido' => $this->pedido->id,
            ]);
        }
        $this->reset(['id_cliente', 'id_vestimenta', 'cantidad']);
    }
}
