<?php

namespace App\Http\Livewire\Inventario;

use App\Models\inventario\Material;
use App\Models\inventario\NotaIngreso;
use App\Models\inventario\NotaSalida;
use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Notas extends Component
{
    use WithPagination;

    public NotaIngreso $notaIngreso;
    public NotaSalida $notaSalida;
    public User $usuario;

    protected $rules = [
        'notaIngreso.fecha' => 'required',
        'notaIngreso.monto_total' => 'required',
        'notaSalida.descripcion' => 'required',
        'notaIngreso.detalles.*.id_material' => 'required',
        'notaIngreso.detalles.*.cantidad' => 'required',
        'notaIngreso.detalles.*.precio' => 'required',
        'notaSalida.detalles.*.cantidad' => 'required',
        'notaSalida.detalles.*.id_material' => 'required',
    ];

    protected $messages = [
        'notaIngreso.detalles.*.cantidad.required' => 'Debe introducir la cantidad',
        'notaIngreso.detalles.*.precio.required' => 'Debe introducir el precio',
        'notaIngreso.detalles.*.id_material.required' => 'Debe seleccionar un material',
    ];

    public function render()
    {
        return view('livewire.inventario.notas', [
            'notasIngreso' => NotaIngreso::with(['almacen', 'usuario'])->paginate(12),
            'notasSalida' => NotaSalida::with(['almacen', 'usuario'])->paginate(12),
            'materiales' => Material::all(),
            'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', $this->usuario->rol->id);
            })->where('nombre', 'LIKE', "nota%")
                ->pluck('nombre')->toArray(),
        ]);
    }

    public function mount()
    {
        $this->notaIngreso = new NotaIngreso();
        $this->notaSalida = new NotaSalida();
        $this->usuario = Auth::user();
    }

    // Métodos para Notas de Ingreso

    /**
     * Carga la propiedad notaIngreso para mostrarlo (en un modal) en la vista
     * @param Model nota
     * @return void
     */
    public function cargarNotaIngreso(NotaIngreso $nota)
    {
        $this->notaIngreso = $nota;
    }

    public function actualizarNotaIngreso()
    {
        $this->validate([
            'notaIngreso.fecha' => 'required',
            'notaIngreso.monto_total' => 'required',
            'notaIngreso.detalles.*.id_material' => 'required',
            'notaIngreso.detalles.*.cantidad' => 'required',
            'notaIngreso.detalles.*.precio' => 'required',
        ]);
        $this->notaIngreso->detalles->each->save();
        $this->usuario->generarBitacora('Nota de ingreso actualizada, id: ' . $this->notaIngreso->id);
        $this->emit('notaIngresoActualizada');
        $this->dispatchBrowserEvent('cerrar-edicion-ni');
        $this->resetErrorBag();
    }

    // Métodos para Notas de Salida
    public function cargarNotaSalida(NotaSalida $nota)
    {
        $this->notaSalida = $nota;
    }

    public function actualizarNotaSalida()
    {
        $this->validate([
            'notaSalida.descripcion' => 'required',
            'notaSalida.detalles.*.cantidad' => 'required',
            'notaSalida.detalles.*.id_material' => 'required',
        ]);
        $this->notaSalida->push();
        $this->usuario->generarBitacora('Nota de salida actualizada, id: ' . $this->notaSalida->id);
        $this->emit('notaSalidaActualizada');
        $this->dispatchBrowserEvent('cerrar-edicion-ns');
    }

    // Métodos utiles para la vista
    public function cancelar()
    {
        $this->dispatchBrowserEvent('cerrar-detalles-ni');
        $this->dispatchBrowserEvent('cerrar-detalles-ns');
        $this->dispatchBrowserEvent('cerrar-edicion-ns');
        $this->dispatchBrowserEvent('cerrar-edicion-ni');
        $this->reiniciarPropiedades();
        $this->resetErrorBag();
    }

    public function reiniciarPropiedades()
    {
        $this->notaSalida = new NotaSalida();
        $this->notaIngreso = new NotaIngreso();
    }
}
