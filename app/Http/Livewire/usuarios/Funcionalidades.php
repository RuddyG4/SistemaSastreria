<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Funcionalidades extends Component
{
    use WithPagination;
    public $id_funcionalidad, $busqueda;
    public Funcionalidad $funcionalidad;
    public User $authenticatedUser;

    protected $listeners = ['delete'];

    protected $rules = [
        'funcionalidad.nombre' => 'required|unique:funcionalidad|max:40',
        'funcionalidad.descripcion' => 'required|max:120',
    ];

    protected $messages = [
        'funcionalidad.nombre.required' => 'El nombre es obligatorio',
        'funcionalidad.nombre.unique' => 'Ya existe una funcionalidad con este nombre.',
        'funcionalidad.nombre.max' => 'El nombre no debe tener más de 40 carácteres',
        'funcionalidad.descripcion.required' => 'La descripcion es obligatoria',
        'funcionalidad.descripcion.max' => 'La descripcion no debe contener más de 120 carácteres',
    ];

    public function render()
    {
        return view(
            'livewire.usuarios.funcionalidades',
            [
                'funcionalidades' => Funcionalidad::Where('nombre', 'LIKE', "%$this->busqueda%")
                    ->paginate(12),
                'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                    $query->where('id', $this->authenticatedUser->rol->id);
                })->where('nombre', 'LIKE', "funcionalidad%")
                    ->pluck('nombre')->toArray()
            ]
        );
    }

    public function mount()
    {
        $this->authenticatedUser = Auth::user();
        $this->funcionalidad = new Funcionalidad();
    }

    public function updated($propertyName)
    {
        if ($this->id_funcionalidad == null) {
            $this->validateOnly($propertyName);
        } else {
            $this->validateOnly($propertyName, [
                'funcionalidad.nombre' => 'required|max:40',
                'funcionalidad.descripcion' => 'required|max:120',
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
        $this->validate();
        $this->funcionalidad->save();
        $this->authenticatedUser->generarBitacora('Funcionalidad creada, id: '.$this->funcionalidad->id);
        $this->emit('funcionalidadCreada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function editar(Funcionalidad $funcionalidad)
    {
        $this->funcionalidad = $funcionalidad;
    }

    public function update()
    {
        $this->validate([
            'funcionalidad.nombre' => 'required|max:40',
            'funcionalidad.descripcion' => 'required|max:120',
        ]);
        $this->funcionalidad->save();
        $this->authenticatedUser->generarBitacora('Funcionalidad actualizada, id: '.$this->funcionalidad->id);
        $this->emit('funcionalidadActualizada');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function delete(Funcionalidad $funcionalidad)
    {
        $funcionalidad->delete();
        $this->authenticatedUser->generarBitacora("Funcionalidad eliminada, id: $funcionalidad->id");
    }

    public function limpiarDatos()
    {
        $this->reset(['id_funcionalidad']);
        $this->funcionalidad = new Funcionalidad();
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
