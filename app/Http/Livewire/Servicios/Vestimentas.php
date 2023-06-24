<?php

namespace App\Http\Livewire\Servicios;

use Livewire\Component;
use App\Models\servicios\Vestimenta;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

;


class Vestimentas extends Component
{   
    use WithPagination;
    public $id_vestimenta, $nombre, $nombreEdit, $genero, $generoEdit, $eleccion, $busqueda;
    public $listDeHabilitada;
    public function render()
    {
        $this->listDeHabilitada = Vestimenta::where('activo', 1)->get();

        return view('livewire.servicios.vestimentas',[
            'listVestimenta' => Vestimenta::where('nombre', 'LIKE', "%$this->busqueda%")
            ->where('activo', 0)
            ->paginate(10)
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
        $vestimenta = Vestimenta::create([
            'nombre' => $this->nombre,
            'genero' => $this->genero
        ]);
        Auth::user()->generarBitacora("Vestimenta creada, id: $vestimenta->id");
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
        Auth::user()->generarBitacora("Vestimenta modificada, id: $vestimenta->id");
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
        Auth::user()->generarBitacora("Vestimenta eliminada, id: $vestimenta->id");
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
