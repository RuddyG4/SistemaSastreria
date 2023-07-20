<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Cliente;
use App\Models\servicios\UnidadVestimenta;
use App\Models\servicios\Vestimenta;
use Livewire\Component;

class AsignarVestimentas extends Component
{
    public $pedido, $id_pedido, $vestimentasSinAsignar;
    public $id_cliente, $id_vestimenta, $cantidad, $modalAbierto = false;

    protected $rules = [
        'id_cliente' => 'required',
        'id_vestimenta' => 'required',
        'cantidad' => 'required',
    ];

    public function render()
    {
        if ($this->modalAbierto) {
            return view('livewire.servicios.pedidos.asignar-vestimentas', [
                'clientes' => Cliente::with('persona')->get(),
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
        } else {
            return view('livewire.servicios.pedidos.asignar-vestimentas');
        }
    }

    public function mount($pedido)
    {
        $this->vestimentasSinAsignar = $pedido->detalles_sum_cantidad - $pedido->vestimentas_count;
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
        $this->vestimentasSinAsignar = $this->vestimentasSinAsignar - $this->cantidad;
        $this->emit('vestimentaAsignada');
        $this->reset(['id_cliente', 'id_vestimenta', 'cantidad']);
    }
}
