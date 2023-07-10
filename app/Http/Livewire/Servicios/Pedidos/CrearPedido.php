<?php

namespace App\Http\Livewire\Servicios\Pedidos;

use App\Models\servicios\DetallePedido;
use App\Models\servicios\FechaPago;
use App\Models\servicios\Pedido;
use App\Models\servicios\Vestimenta;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrearPedido extends Component
{
    public Pedido $pedido;
    public DetallePedido $detalle;
    public User $usuario;
    public $fechas, $detalles;
    public $busqueda, $clientes, $step = 1, $cantidad, $id_vestimenta, $pagoInicial, $fecha, $monto;

    protected $listeners = ['irAPedidos'];

    protected $rules = [
        'pedido.descripcion' => 'required',
        'pedido.id_cliente' => 'required',
        'pedido.tipo' => 'required',
        'detalle.cantidad' => 'required',
        'detalle.id_vestimenta' => 'required',
        'detalles.*.cantidad' => 'required',
        'detalles.*.id_vestimenta' => 'required',
        'fechas.*.fecha' => 'required',
        'fechas.*.monto' => 'required',
    ];

    protected $messages = [
        'pedido.descripcion.required' => 'Debe ingresar una descripcion del pedido',
        'pedido.id_cliente.required' => 'Debe seleccionar el cliente encargado del pedido',
        'pedido.tipo.required' => 'Debe seleccionar el tipo del pedido',
        'cantidad.required' => 'Debe ingresar la cantidad',
        'id_vestimenta.required' => 'Debe seleccionar una vestimenta',
        'monto.required' => 'Debe ingresar un monto',
        'fecha.required' => 'Debe ingresar una fecha',
        'pagoInicial.required' => 'Debe ingresar un pago inicial',
    ];

    public function render()
    {
        $this->clientes = Persona::whereHas('cliente')
            ->where('ci', 'like', "$this->busqueda%")
            ->get();
        return view('livewire.servicios.pedidos.crear-pedido', [
            'vestimentas' => Vestimenta::All(),
        ]);
    }

    public function mount()
    {
        $this->pedido = new Pedido();
        $this->detalle = new DetallePedido();
        $this->detalles = new Collection();
        $this->fechas = new Collection();
        $this->usuario = Auth::user();
    }

    /**
     * Agrega una vestimenta al pedido
     * @return void
     */
    public function adicionarDetallePedido()
    {
        $datos = $this->validate([
            'cantidad' => 'required',
            'id_vestimenta' => 'required',
        ]);
        $this->detalle = new DetallePedido($datos);
        $this->detalles->push($this->detalle);
        $this->limpiarDetalle();
    }

    /**
     * Limpia las variables usadas al agregar una vestimenta al pedido
     * @return void
     */
    public function limpiarDetalle()
    {
        $this->detalle = new DetallePedido();
        $this->reset(['cantidad', 'id_vestimenta']);
    }

    /**
     * Quita una vestimenta del pedido
     * @return void
     */
    public function quitarDetallePedido($id)
    {
        unset($this->detalles[$id]);
    }

    /**
     * Agrega una fecha de pago al pedigo
     * @return void
     */
    public function adicionarFechaPago()
    {
        $this->fechas->push(new FechaPago($this->validate([
            'fecha' => 'required',
            'monto' => 'required',
        ])));
        $this->reset(['fecha', 'monto']);
    }

    public function quitarFechaPago($id)
    {
        unset($this->fechas[$id]);
    }

    /**
     * Valida los múltiples pasos del formulario multi-step
     * @return void
     */
    public function validarPasoActual()
    {
        switch ($this->step) {
            case 1:
                $this->validate([
                    'pedido.descripcion' => 'required',
                    'pedido.id_cliente' => 'required',
                    'pedido.tipo' => 'required',
                ]);
                break;
            case 2:
                if ($this->detalles->isEmpty()) {
                    session()->flash('message');
                    return false;
                }
                break;
            case 3;
                $this->validate([
                    'pagoInicial' => 'required',
                ]);
                $this->fechas->push(new FechaPago([
                    'fecha' => now()->toDateString(),
                    'monto' => $this->pagoInicial,
                ]));
                break;
        }
        return true;
    }

    /**
     * Selecciona al cliente encargado del Pedido (ocurre luego de la validación)
     * @param Int $id
     * @return void
     */
    public function seleccionarCliente($id)
    {
        $this->pedido->id_cliente = $id;
        $this->reset('busqueda');
    }

    /**
     * Salta al siguiente paso del formulario
     * @return void
     */
    public function nextStep()
    {
        if ($this->validarPasoActual())
            $this->step++;
    }

    /**
     * Vuelve al paso anterior del formulario
     * @return void
     */
    public function previousStep()
    {
        if ($this->step > 1)
            $this->step--;
    }

    public function crearPedido()
    {
        $this->pedido->fill([
            'fecha_recepcion' => now(),
            'estado_avance' => 0,
            'id_usuario' => $this->usuario->id,
        ]);
        $this->pedido->save();
        foreach ($this->detalles as $detalle) {
            $detalle->id_pedido = $this->pedido->id;
            $detalle->save();
        }
        foreach ($this->fechas as $fechaPago) {
            $fechaPago->id_pedido = $this->pedido->id;
            $fechaPago->save();
        }
        return redirect('/dashboard/adm_servicios/pedidos');
    }

    public function irAPedidos()
    {
        return redirect('/dashboard/adm_servicios/pedidos');
    }
}
