<?php

namespace App\Http\Livewire\Servicios;

use App\Models\servicios\Cliente;
use App\Models\usuarios\Persona;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Clientes extends Component
{
    public $busqueda;
    public $nombre, $apellido, $ci, $direccion, $id_persona;
    
    public function render()
    {
        return view(
            'livewire.servicios.clientes',
            [
                'clientes' => Cliente::whereHas('persona', function (Builder $query) {
                    $query->where('nombre', 'like', "%$this->busqueda%")
                    ->orWhere('apellido', 'like', "%$this->busqueda%");
                })->get(),
            ]
        );
    }

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'ci' => 'required|numeric|unique:persona',
        'direccion' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'apellido.required' => 'El apellido es obligatorio',
        'ci.required' => 'El C.I. es obligatorio',
        'ci.numeric' => 'El C.I. solo debe contener números',
        'ci.unique' => 'El C.I. ingresado ya existe',
        'direccion.required' => 'Debe ingresar una direccion.',
    ];

    public function updated($propertyName)
    {
        if ($this->id_persona == null) {
            $this->validateOnly($propertyName);
        } else {
            $this->validateOnly($propertyName, [
                'nombre' => 'required',
                'apellido' => 'required',
                'ci' => 'required|numeric',
                'direccion' => 'required',
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
        $persona = Persona::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'ci' => $this->ci,
        ]);
        $cliente = new Cliente;
        $cliente->direccion = $this->direccion;
        $persona->cliente()->save($cliente);
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function editar($id)
    {
        $persona = Persona::find($id);
        $this->nombre = $persona->nombre;
        $this->apellido = $persona->apellido;
        $this->ci = $persona->ci;
        $this->direccion = $persona->cliente->direccion;
        $this->id_persona = $id;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'ci' => 'required|numeric',
            'direccion' => 'required',
        ]);
        $persona = Persona::find($this->id_persona);
        $persona->nombre = $this->nombre;
        $persona->apellido = $this->apellido;
        $persona->ci = $this->ci;
        $persona->cliente->direccion = $this->direccion;
        $persona->push();
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'apellido', 'ci', 'direccion', 'id_persona']);
    }

}
