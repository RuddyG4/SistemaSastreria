<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Funcionalidad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Funcionalidades extends Component
{
    use WithPagination;
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
        return view(
            'livewire.usuarios.funcionalidades',
            [
                'funcionalidades' => Funcionalidad::Where('nombre', 'LIKE', "%$this->busqueda%")
                    ->paginate(12),
                'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                    $query->where('id', Auth::user()->rol->id);
                })->where('nombre', 'LIKE', "funcionalidad%")
                    ->pluck('nombre')->toArray()
            ]
        );
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
        $funcionalidad = Funcionalidad::create($this->validate());
        Auth::user()->generarBitacora("Funcionalidad creada, id: $funcionalidad->id");
        $this->emit('funcionalidadCreada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function editar(Funcionalidad $funcionalidad)
    {
        $this->nombre = $funcionalidad->nombre;
        $this->descripcion = $funcionalidad->descripcion;
        $this->id_funcionalidad = $funcionalidad->id;
    }

    public function update(Funcionalidad $funcionalidad)
    {
        $datos = $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        $funcionalidad->update($datos);
        Auth::user()->generarBitacora("Funcionalidad actualizada, id: $funcionalidad->id");
        $this->emit('funcionalidadActualizada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function delete(Funcionalidad $funcionalidad)
    {
        $funcionalidad->delete();
        Auth::user()->generarBitacora("Funcionalidad eliminada, id: $funcionalidad->id");
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'descripcion', 'id_funcionalidad']);
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
