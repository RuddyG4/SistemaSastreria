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
        'pedido.descripcion' => 'required|string|max:100',
        'pedido.id_cliente' => 'required|integer',
        'pedido.tipo' => 'required|boolean',
        'detalle.cantidad' => 'required',
        'detalle.id_vestimenta' => 'required',
        'detalles.*.cantidad' => 'required',
        'detalles.*.id_vestimenta' => 'required',
        'fechas.*.fecha' => 'required',
        'fechas.*.monto' => 'required',
    ];

    protected $messages = [
        'pedido.descripcion.required' => 'Debe ingresar una descripcion del pedido',
        'pedido.descripcion.string' => 'La descripcion del pedido debe ser una cadena',
        'pedido.descripcion.max' => 'La descripcion solo puede tener hasta 100 carácteres',
        'pedido.id_cliente.required' => 'Debe seleccionar el cliente encargado del pedido',
        'pedido.tipo.required' => 'Debe seleccionar el tipo del pedido',
        'cantidad.required' => 'Debe ingresar la cantidad',
        'cantidad.integer' => 'La cantidad debe ser un número entero (sin decimales)',
        'id_vestimenta.required' => 'Debe seleccionar una vestimenta',
        'monto.required' => 'Debe ingresar un monto',
        'monto.decimal' => 'El monto debe tener entre 0 y 2 decimales',
        'fecha.required' => 'Debe ingresar una fecha',
        'fecha.after_or_equal' => 'La fecha debe ser mayor a hoy',
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
            'cantidad' => 'required|integer',
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
            'fecha' => 'required|after_or_equal:today',
            'monto' => 'required|decimal:0,2',
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
                    'pedido.descripcion' => 'required|string|max:100',
                    'pedido.id_cliente' => 'required|integer',
                    'pedido.tipo' => 'required|boolean',
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
            if ($this->step < 4)
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

        $this->fechas->push(new FechaPago([
            'fecha' => now()->toDateString(),
            'monto' => $this->pagoInicial,
        ]));
        foreach ($this->fechas as $fechaPago) {
            $fechaPago->id_pedido = $this->pedido->id;
            $fechaPago->save();
        }
        $this->usuario->generarBitacora('Pedido creado, id: ' . $this->usuario->id);
        return redirect('/dashboard/adm_servicios/pedidos');
    }

    public function irAPedidos()
    {
        return redirect('/dashboard/adm_servicios/pedidos');
    }
}
