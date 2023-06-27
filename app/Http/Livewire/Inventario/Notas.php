<?php

namespace App\Http\Livewire\Inventario;

use App\Models\inventario\Material;
use App\Models\inventario\NotaIngreso;
use App\Models\inventario\NotaSalida;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Notas extends Component
{
    use WithPagination;

    public NotaIngreso $notaIngreso;
    public NotaSalida $notaSalida;

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

    public function render()
    {
        return view('livewire.inventario.notas', [
            'notasIngreso' => NotaIngreso::paginate(12),
            'notasSalida' => NotaSalida::paginate(12),
            'materiales' => Material::all(),
        ]);
    }

    public function mount()
    {
        $this->notaIngreso = new NotaIngreso();
        $this->notaSalida = new NotaSalida();
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
        $this->emit('notaIngresoActualizada');
        $this->dispatchBrowserEvent('cerrar-edicion-ni');
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
        $this->notaSalida->save();
        $this->notaSalida->detalles->each->save();
        $this->emit('notaSalidaActualizada');
        $this->dispatchBrowserEvent('cerrar-edicion-ns');
    }

    // Métodos utiles para la vista
    public function cancelar()
    {
        $this->dispatchBrowserEvent('cerrar-detalles-ni');
        $this->dispatchBrowserEvent('cerrar-detalles-ns');
        $this->reiniciarPropiedades();
        $this->resetErrorBag();
    }

    public function reiniciarPropiedades()
    {
        $this->notaSalida = new NotaSalida();
        $this->notaIngreso = new NotaIngreso();
    }
}
