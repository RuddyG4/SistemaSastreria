<?php

namespace App\Http\Livewire\Servicios;

use Livewire\Component;
use App\models\servicios\Vestimenta;
use Illuminate\Contracts\Database\Eloquent\Builder;;


class Vestimentas extends Component
{   
    public $id_vestimenta, $nombre, $nombreEdit, $genero, $generoEdit, $eleccion, $busqueda;
    public $listDeHabilitada;
    public function render()
    {
        $this->listDeHabilitada = Vestimenta::where('activo', 1)->get();

        return view('livewire.servicios.vestimentas',[
            'listVestimenta' => Vestimenta::where('nombre', 'LIKE', "%$this->busqueda%")
            ->paginate(8)
        ]);
    }


    protected $rules = [
        'nombre' => 'required',
        'nombreEdit' => 'required',
        'genero' => 'required',
        'generoEdit' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'genero.required' => 'El genero es obligatorio',
        'nombreEdit.required' => 'El nombre es obligatorio',
        'generoEdit.required' => 'El genero es obligatorio',
    ];


    public function store()
    {
        // $this->validate();
        Vestimenta::create([
            'nombre' => $this->nombre,
            'genero' => $this->genero
        ]);
        $this->close();
    }


    public function edit($idVestimenta)
    {
        $this->id_vestimenta = $idVestimenta;
        $vestimenta = Vestimenta::findOrFail($idVestimenta);
        $this->nombreEdit = $vestimenta->nombre;
        $this->generoEdit = $vestimenta->genero;
    }

    public function update()
    {
        $this->validate([
            'nombreEdit' => 'required',
            'generoEdit' => 'required'
        ]);
        $vestimenta = Vestimenta::findOrFail($this->id_vestimenta);
        $vestimenta->nombre = $this->nombreEdit;
        $vestimenta->genero = $this->generoEdit;
        $vestimenta->push();
        $this->cancelEdit();
    }
    public function cancelEdit()
    {
        $this->id_vestimenta = null;
    }

    public function disactivate($id)
    {
        $this->generoEdit = $id;
        $vestimenta = Vestimenta::findOrFail($id);
        $vestimenta->activo = '1';
        $vestimenta->push();
    }

    public function activate($id)
    {
        $vestimenta = Vestimenta::findOrFail($id);
        $vestimenta->activo = '0';
        $vestimenta->push();
    }

    public function close()
    {
        $this->reset(['id_vestimenta', 'nombre']);
        $this->dispatchBrowserEvent('cerrar-modal-vista');
        $this->resetErrorBag();
    }
    public function mount()
    {
        $this->genero = '1';
    }
}
