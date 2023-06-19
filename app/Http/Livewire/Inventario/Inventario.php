<?php

namespace App\Http\Livewire\Inventario;

use App\Models\inventario\Almacen;
use App\Models\inventario\DetalleNotaIngreso;
use App\Models\inventario\DetalleNotaSalida;
use App\Models\inventario\Inventario as MInventario;
use App\Models\inventario\Material;
use App\Models\inventario\NotaIngreso;
use App\Models\inventario\NotaSalida;
use Illuminate\Contracts\Database\Eloquent\Builder;;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Inventario extends Component
{
    public $busqueda, $almacen;
    public $detalles, $detallesSalida, $id_material, $cantidad, $precio, $descripcion;

    protected $rules = [
        'id_material' => 'required|numeric',
        'cantidad' => 'required|numeric|integer',
        'precio' => 'required|decimal:0,2',
        'detalles.*.id_material' => 'required|numeric',
        'detalles.*.cantidad' => 'required|numeric|integer',
        'detalles.*.precio' => 'required|decimal:0,2',
        'detallesSalida.*.id_material' => 'required|numeric',
        'detallesSalida.*.cantidad' => 'required|numeric|integer',
    ];

    protected $messages = [
        'id_material.required' => 'Debe seleccionar un material',
        'descripcion.required' => 'Debe agregar una descripcion o motivo de salida',
        'cantidad.required' => 'Debe ingresar la cantidad a agregar',
        'cantidad.numeric' => 'La cantidad debe ser un numero',
        'cantidad.integer' => 'La cantidad debe ser un numero entero',
        'precio.required' => 'Debe ingresar el precio del material',
        'precio.decimal' => 'El precio del material debe ser un numero con hasta 2 decimales',
    ];

    public function render()
    {
        $almacenes = Almacen::all();
        if ($almacenes->isEmpty()) {
            return view('livewire.inventario.inventario');
        } else {
            $this->almacen = $almacenes->first();
            return view('livewire.inventario.inventario', [
                'almacenes' => $almacenes,
                'materiales' => Material::all(),
                'datos' => MInventario::Where('id_almacen', $this->almacen->id)->whereHas('material', function (Builder $query) {
                    $query->where('nombre', 'like', "%$this->busqueda%");
                })->get(),
                // 'datos' => MInventario::Where('id_almacen', $this->almacen->id)->get(),
            ]);
        }
    }

    public function mount()
    {
        $this->detalles = new \Illuminate\Database\Eloquent\Collection();
        $this->detallesSalida = new \Illuminate\Database\Eloquent\Collection();
    }

    // Métodos para el manejo de las notas de ingreso
    public function guardarNotaIngreso()
    {
        if (!$this->detalles->isEmpty()) {
            $nota = NotaIngreso::create([
                'id_usuario' => Auth::user()->id,
                'id_almacen' => $this->almacen->id,
                'fecha' => now(),
                'monto total' => 0,
            ]);
            foreach($this->detalles as $detalle) {
                $detalle->id_nota = $nota->id;
                $detalle->save();
            }
            $this->limpiarDatos();
            $this->dispatchBrowserEvent('cerrar-modal');
            $this->emit('notaIngresoCreada');
        } else {
            session()->flash('message');
        }
        $this->resetErrorBag();
    }

    public function adicionarMaterialIngreso()
    {
        $datos = $this->validate();
        $detalleNota = new DetalleNotaIngreso($datos);
        $this->detalles->push($detalleNota);
        $this->limpiarDetalle();
    }

    public function quitarMaterialIngreso($indice)
    {
        unset($this->detalles[$indice]);
    }

    // Métodos para el manejo de las notas de salida
    public function guardarNotaSalida()
    {
        if (!$this->detallesSalida->isEmpty()) {
            $this->validate([
                'descripcion' => 'required|max:100',
            ]);
            $nota = NotaSalida::create([
                'id_usuario' => Auth::user()->id,
                'id_almacen' => $this->almacen->id,
                'fecha' => now(),
                'descripcion' => $this->descripcion,
            ]);
            foreach($this->detallesSalida as $detalle) {
                $detalle->id_nota = $nota->id;
                $detalle->save();
            }
            $this->limpiarDatos();
            $this->dispatchBrowserEvent('cerrar-modal-sm');
            $this->emit('notaSalidaCreada');
        } else {
            session()->flash('message');
        }
        $this->resetErrorBag();
    }

    public function adicionarMaterialSalida()
    {
        $datos = $this->validate([
            'id_material' => 'required|numeric',
            'cantidad' => 'required|numeric|integer',
        ]);
        $detalleNotaSalida = new DetalleNotaSalida($datos);
        $this->detallesSalida->push($detalleNotaSalida);
        $this->limpiarDetalle();
    }

    public function quitarMaterialSalida($indice)
    {
        unset($this->detallesSalida[$indice]);
    }

    // Métodos utiles para la vista
    public function cancelar()
    {
        $this->dispatchBrowserEvent('cerrar-modal');
        $this->dispatchBrowserEvent('cerrar-modal-sm');
        $this->limpiarDatos();
        $this->resetErrorBag();
    }

    public function limpiarDetalle()
    {
        $this->reset(['id_material', 'cantidad', 'precio', 'descripcion']);
    }

    public function limpiarDatos()
    {
        $this->reset(['id_material', 'cantidad', 'precio', 'descripcion']);
        $this->detalles = new \Illuminate\Database\Eloquent\Collection();
        $this->detallesSalida = new \Illuminate\Database\Eloquent\Collection();
    }
}