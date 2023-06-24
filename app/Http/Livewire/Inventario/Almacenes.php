<?php

namespace App\Http\Livewire\Inventario;

use Livewire\Component;
use App\Models\inventario\Almacen;
use App\Models\usuarios\Funcionalidad;
use Illuminate\Support\Facades\Auth;

class Almacenes extends Component
{
    public $idAlma, $nombre, $ubicacion;

    public function render()
    {
        return view('livewire.inventario.almacenes', [
            'almacenes' => Almacen::get(),
            'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', Auth::user()->rol->id);
            })->where('nombre', 'LIKE', "almacen%")
                ->pluck('nombre')->toArray(),
        ]);
    }

    protected $rules = [
        'nombre' => 'required|unique:funcionalidad',
        'ubicacion' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.unique' => 'Ya existe una funcionalidad con este nombre.',
        'ubicacion.required' => 'La ubicacion es obligatoria',
    ];

    public function store()
    {
        $almacen = Almacen::create($this->validate());
        Auth::user()->generarBitacora("Almacen creado, id: $almacen->id");
        $this->cerrar();
    }

    public function delete(Almacen $almacen)
    {
        $almacen->update(['eliminado' => 1]);
        Auth::user()->generarBitacora("Almacen eliminado, id: $almacen->id");
        $this->cerrar();
    }

    public function editar(Almacen $almacen)
    {
        $this->idAlma = $almacen->id;
        $this->nombre = $almacen->nombre;
        $this->ubicacion = $almacen->ubicacion;
    }
    public function update()
    {
        $datos = $this->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);
        $almacen = Almacen::find($this->idAlma);
        $almacen->update($datos);
        Auth::user()->generarBitacora("Almacen modificado, id: $almacen->id");
        $this->cerrar();
    }

    public function cerrar()
    {
        $this->reset(['nombre', 'ubicacion', 'idAlma']);
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->resetErrorBag();
    }
}
