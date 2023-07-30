<?php

namespace App\Http\Livewire\Servicios;

use App\Models\servicios\Cliente;
use App\Models\servicios\Telefono;
use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    public $busqueda;
    public $nombre, $apellido, $ci, $direccion, $id_persona, $telefono;
    public User $usuario;

    protected $listeners = ['delete'];

    public function render()
    {
        return view('livewire.servicios.clientes', [
            'clientes' => Cliente::addSelect([
                'numero' => Telefono::select('numero')
                    ->whereColumn('id_cliente', 'cliente.id')
                    ->limit(1)
            ])->whereHas('persona', function ($query) {
                $query->where('nombre', 'like', "%$this->busqueda%")
                    ->orWhere('apellido', 'like', "%$this->busqueda%");
            })->with('persona')->paginate(12),
            'permisos' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', $this->usuario->rol->id);
            })->where('nombre', 'LIKE', "cliente.%")
                ->pluck('nombre')->toArray(),
        ]);
    }

    public function mount()
    {
        $this->usuario = Auth::user();
    }

    protected $rules = [
        'nombre' => 'required|string|max:40',
        'apellido' => 'required|max:40',
        'ci' => 'required|numeric|unique:persona',
        'direccion' => 'required|max:50',
        'telefono' => 'required|numeric|integer',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'nombre.max' => 'El nombre debe tener un maximo de 40 caracteres',
        'apellido.required' => 'El apellido es obligatorio',
        'apellido.max' => 'El apellido debe tener un maximo de 40 caracteres',
        'ci.required' => 'El C.I. es obligatorio',
        'ci.numeric' => 'El C.I. solo debe contener números',
        'ci.unique' => 'El C.I. ingresado ya existe',
        'direccion.required' => 'Debe ingresar una direccion',
        'direccion.max' => 'La direccion debe tener un maximo de 50 caracteres',
        'telefono.required' => 'Debe ingresar un telefono',
        'telefono.numeric' => 'El telefono deber ser un numero tefefonico valido',
        'telefono.integer' => 'El telefono deber ser un numero tefefonico valido (entero)',
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
        $datos = $this->validate();
        $persona = Persona::create($datos);
        $cliente = new Cliente($datos);
        $persona->cliente()->save($cliente);
        Telefono::create([
            'numero' => $this->telefono,
            'id_cliente' => $persona->id,
            'tipo' => 0,
        ]);
        $this->usuario->generarBitacora("Cliente creado, id: $persona->id");
        $this->emit('clienteCreado');
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
        $datos = $this->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'ci' => 'required|numeric',
            'direccion' => 'required',
        ]);
        $persona = Persona::find($this->id_persona);
        $persona->update($datos);
        $persona->cliente->update($datos);
        $this->usuario->generarBitacora("Cliente modificado, id: $persona->id");
        $this->emit('clienteActualizado');
        $this->limpiarDatos();
        $this->dispatchBrowserEvent('cerrar-modal-edicion');
    }

    public function delete(Persona $persona)
    {
        $persona->cliente()->delete();
        $persona->delete();
        $this->usuario->generarBitacora("Cliente eliminado, id: $persona->id");
    }

    public function limpiarDatos()
    {
        $this->reset(['nombre', 'apellido', 'ci', 'direccion', 'id_persona', 'telefono']);
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
