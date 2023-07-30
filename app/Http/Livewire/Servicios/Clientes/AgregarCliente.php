<?php

namespace App\Http\Livewire\Servicios\Clientes;

use App\Models\servicios\Cliente;
use App\Models\servicios\Telefono;
use App\Models\usuarios\Persona;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AgregarCliente extends Component
{
    public $nombre, $apellido, $ci, $direccion, $id_persona, $telefono;
    public User $usuario;
    
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

    public function mount()
    {
        $this->usuario = Auth::user();
    }
    
    public function render()
    {
        return view('livewire.servicios.clientes.agregar-cliente');
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
        $this->resetModal();
        $this->dispatchBrowserEvent('cerrar-modal');
    }

    public function resetModal()
    {
        $this->reset(['nombre', 'apellido', 'ci', 'direccion', 'id_persona', 'telefono']);
        $this->resetErrorBag();
    }
}
