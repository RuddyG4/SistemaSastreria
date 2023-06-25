<?php

namespace App\Http\Livewire\Servicios;

use Livewire\Component;
use App\models\servicios\Vestimenta;
use App\models\servicios\Medida;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\WithPagination;

;


class Vestimentas extends Component
{   
    use WithPagination;
    public $id_vestimenta, $nombre, $genero, $busqueda, $id_medida;    
    public $listDeHabilitada, $listMedidas;
    public $listIdMedida, $listaEditar, $listVer, $listaCargar = [];
    

    public function render()
    {
        $this->listDeHabilitada = Vestimenta::where('activo', 1)->get();
        $this->listMedidas = Medida::get();
        return view('livewire.servicios.vestimentas',[
            'listVestimenta' => Vestimenta::where('nombre', 'LIKE', "%$this->busqueda%")
            ->where('activo', 0)
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
        $vestimenta = Vestimenta::create([
            'nombre' => $this->nombre,
            'genero' => $this->genero
        ]);

        $vestimenta->medida()->attach($this->listIdMedida);
        $this->close();
    }

    public function cargar()
    {
        $this->listIdMedida[] = $this->id_medida;
        $this->listIdMedida = array_unique($this->listIdMedida);
        $this->listaCargar[] = $this->id_medida;
        $this->listaCargar = array_unique($this->listIdMedida);
    }
    
    

    public function loadView($id)
    {
        $vestimenta = Vestimenta::findOrFail($id);
        $this->nombre = $vestimenta->nombre;
        $this->genero = $vestimenta->genero;

        $this->listVer = Medida::whereHas('vestimenta', 
            function ($query) use ($id) {
                $query->where('id', $id);}
        )->pluck('nombre');
    }


    public function edit($id)
    {
        $this->id_vestimenta = $id;
        $vestimenta = Vestimenta::findOrFail($id);
        $this->nombre = $vestimenta->nombre;
        $this->genero = $vestimenta->genero;

        $this->listaEditar = Medida::whereHas('vestimenta', 
            function ($query) use ($id) {
                $query->where('id', $id);}
        )->get();

        foreach($this->listaEditar as $list)
            $this->listIdMedida[] = $list->id;
    }

    public function update()
    {
        // $this->validate([
        //     'nombreEdit' => 'required',
        //     'generoEdit' => 'required'
        // ]);
        $vestimenta = Vestimenta::findOrFail($this->id_vestimenta);
        $vestimenta->nombre = $this->nombre;
        $vestimenta->genero = $this->genero;
        $this->listIdMedida = array_filter($this->listIdMedida, function ($value) {
            return $value !== null;
        });
        $vestimenta->medida()->sync($this->listIdMedida);
        
        $this->close();
    }
    public function close()
    {
        $this->reset(['id_vestimenta', 'nombre', 'listIdMedida', 'genero', 'id_medida','listaEditar','listaCargar']);
        $this->dispatchBrowserEvent('cerrar-modal-vista');
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->resetErrorBag();
    }
    
    public function EliminarLista($valor)
    {
        $clave = array_search($valor, $this->listIdMedida);
        if ($clave !== false) {
            unset($this->listIdMedida[$clave]);
}
    }
    public function updatingBusqueda()
    {
        $this->resetPage();
    }
    
}
