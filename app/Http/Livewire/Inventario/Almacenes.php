<?php

namespace App\Http\Livewire\Inventario;

use Livewire\Component;
use App\Models\inventario\Almacen;

class Almacenes extends Component
{
    public $idAlma,$nombre,$ubicacion;


    // funciones
    public function render()
    {
        return view('livewire.inventario.almacenes',[
            'almacenes' => Almacen::get()
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
        $datos = $this->validate();
        Almacen::create($datos);
        $this->cerrar();
    }

    public function delete()
    {
        $almacen = Almacen::find($this->idAlma);
        if ($almacen) {
            $almacen->delete($this->idAlma);
        }
        $this->cerrar();
    }

    public function editar($id_alma)
    {
        $this->idAlma = $id_alma;
        $almacen = Almacen::findOrFail($id_alma);
        $this->nombre = $almacen->nombre;
        $this->ubicacion = $almacen->ubicacion;

    }
    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);
        $almacen = Almacen::find($this->idAlma);
        $almacen->nombre = $this->nombre;
        $almacen->ubicacion = $this->ubicacion;
        $almacen->push();
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
