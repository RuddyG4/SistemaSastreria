<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\Pedido;
use App\Models\servicios\Telefono;
use App\Models\usuarios\Persona;
use Dotenv\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class TablaPedidos extends Component
{
    use WithPagination;

    public $nombre, $fechaDesde, $fechaHasta;

    protected $rules = [
        'nombre' => 'max:40',
        'fechaDesde' => 'date|before_or_equal:today',
        'fechaHasta' => 'date|before_or_equal:today',
    ];

    protected $messages = [
        'nombre.max' => 'El nombre debe un máximo de 40 carácteres',
        'fechaDesde.before_or_equal' => 'La fecha debe ser menor al día de hoy',
        'fechaHasta.befor_or_equal' => 'La fecha debe ser menor al día de hoy',
    ];

    public function render()
    {
        return view('livewire.servicios.pedidos.tabla', [
            'pedidos' => Pedido::addSelect([
                'telefono' => Telefono::select('numero')->whereColumn('id_cliente', 'telefono.id_cliente')->limit(1),
                'nombre_cliente' => Persona::select('nombre')->whereColumn('id_cliente', 'persona.id')->limit(1),
                'apellido_cliente' => Persona::select('apellido')->whereColumn('id_cliente', 'persona.id')->limit(1),
            ])
                ->whereBetween('fecha_recepcion', [$this->fechaDesde, $this->fechaHasta . ' 23:59:59'])
                ->whereHas('cliente.persona', function ($query) {
                    $query->where('nombre', 'like', "%$this->nombre%");
                })
                ->paginate(10),
        ]);
    }

    public function mount()
    {
        $this->fechaDesde = "2023-01-01";
        $this->fechaHasta = now()->toDateString();
    }

    public function aplicarFiltros()
    {
        $this->withValidator(function ($validator) {
            if ($validator->fails()) {
                $this->reiniciarPropiedades();
            }
        })->validate();
    }

    public function reiniciarPropiedades()
    {
        $this->fechaDesde = "2023-01-01";
        $this->fechaHasta = now()->toDateString();
        $this->reset(['nombre']);
    }
}
