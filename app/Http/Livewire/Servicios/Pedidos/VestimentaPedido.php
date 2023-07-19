<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Cliente;
use App\Models\servicios\MedidaVestimenta;
use App\Models\servicios\Pedido;
use App\Models\servicios\UnidadVestimenta;
use Livewire\Component;

class VestimentaPedido extends Component
{
    public $vestimentas, $id_vestimenta;
    public $medidas;
    public Pedido $pedido;

    protected $rules = [
        'medidas.*.valor' => 'required',
    ];

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

    /**
     * Carga las vestimentas de un cliente (propietario)
     * @param Int $id_propietario (id del cliente propietario)
     * @return void
     */
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
        $this->verVestimentas($vestimenta->id_cliente);
    }

    public function cambiarMedidas($id_unidad_vestimenta)
    {
        $this->id_vestimenta = $id_unidad_vestimenta;
        $this->medidas = MedidaVestimenta::where('id_unidad_vestimenta', $id_unidad_vestimenta)->get();
    }

    public function guardarMedidas($id_propietario)
    {
        foreach($this->medidas as $medida) {
            $medida->save();
        }
        $vestimenta = UnidadVestimenta::find($this->id_vestimenta);
        $vestimenta->fecha_cambio = now();
        $vestimenta->save();
        $this->verVestimentas($id_propietario);
        $this->reset(['medidas', 'id_vestimenta']);
    }

    public function cancelar()
    {
        // 
    }
}
