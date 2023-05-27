<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Funcionalidad;
use Livewire\Component;

class Funcionalidades extends Component
{
    public $busqueda, $nombre, $descripcion, $id_funcionalidad;

    protected $listeners = ['delete'];

    protected $rules = [
        'nombre' => 'required|unique:funcionalidad',
        'descripcion' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.unique' => 'Ya existe una funcionalidad con este nombre.',
        'descripcion.required' => 'La descripcion es obligatoria',
    ];
    
    public function render()
    {
        return view('livewire.usuarios.funcionalidades',
        [
            'funcionalidades' => Funcionalidad::Where('nombre', 'LIKE', "%$this->busqueda%")
                ->get(),
        ]);
    }

    public function updated($propertyName)
    {
        if ($this->id_funcionalidad == null) {
            $this->validateOnly($propertyName);
        } else {
            $this->validateOnly($propertyName, [
                'nombre' => 'required',
                'descripcion' => 'required',
            ]);
        }
    }

    public function cancelar()
    {
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
        $this->resetErrorBag();
    }

    public function store()
    {
        $datos = $this->validate();
        Funcionalidad::create($datos);
        $this->emit('funcionalidadCreada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function editar($id)
    {
        $funcionalidad = Funcionalidad::find($id);
        $this->nombre = $funcionalidad->nombre;
        $this->descripcion = $funcionalidad->descripcion;
        $this->id_funcionalidad = $id;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $funcionalidad = Funcionalidad::find($this->id_funcionalidad);
        $funcionalidad->nombre = $this->nombre;
        $funcionalidad->descripcion = $this->descripcion;
        $funcionalidad->save();
        $this->emit('funcionalidadActualizada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function delete(Funcionalidad $funcionalidad)
    {
        $funcionalidad->delete();
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'descripcion', 'id_funcionalidad']);
    }

}
