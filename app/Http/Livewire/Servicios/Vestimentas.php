<?php

namespace App\Http\Livewire\Servicios;


use Livewire\Component;
use App\Models\servicios\Vestimenta;
use App\Models\servicios\Medida;
use App\Models\usuarios\Rol;
use App\Models\usuarios\User;
use App\Models\usuarios\Funcionalidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\WithPagination;

;


class Vestimentas extends Component
{   
    use WithPagination;
    public $id_vestimenta, $nombre, $genero, $busqueda, $id_medida;    
    public $listDeHabilitada, $listMedidas;
    public $listIdMedida, $listaEditar, $listVer, $listaCargar = [];
    public User $usuario;
    

    public $medidaNombre,$idMedida;
    public $mujeres, $hombre;
    public function render()
    {

        $this->listDeHabilitada = Vestimenta::where('activo', 0)->get();
        
        $this->listMedidas = Medida::where('eliminado', 0)->get();
        return view('livewire.servicios.vestimentas',[
            'listVestimenta' => Vestimenta::where('nombre', 'LIKE', "%$this->busqueda%")
            ->where('activo', 0)
            ->paginate(8),

            'rol' => Rol::all(),
            'permisosVestimenta' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', Auth::user()->rol->id);
            })->where('nombre', 'LIKE', "vestimenta.%")
            ->pluck('nombre')->toArray(),
            
            'permisosMedida' => Funcionalidad::whereHas('roles', function ($query) {
                $query->where('id', Auth::user()->rol->id);
            })->where('nombre', 'LIKE', "medidas.%")
            ->pluck('nombre')->toArray(),


            
        ]);
    }

    public function mount()
    {
        $this->usuario = Auth::user();
    }

    protected $rules = [
        'nombre' => 'required',
        'genero' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'genero.required' => 'El genero es obligatorio',
    ];


    public function store()
    {
        $datos = $this->validate();
        $vestimenta = Vestimenta::create($datos);
        

        $listaLimpia = $this->limpiarNull($this->listIdMedida);
        $vestimenta->medida()->attach($listaLimpia);
        $this->usuario->generarBitacora("Vestimenta creada, id: $vestimenta->id");
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
        $this->id_vestimenta = $id;
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

    public function delete()
    {
        $vesimenta= Vestimenta::findOrFail($this->id_vestimenta);
        $vesimenta->activo = '1';
        $vesimenta->push();
        $this->usuario->generarBitacora("Vestimenta eliminada, id: $vesimenta->id");

        $this->close();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'genero' => 'required'
        ]);
        $vestimenta = Vestimenta::find($this->id_vestimenta);
        $vestimenta->nombre = $this->nombre;
        $vestimenta->genero = $this->genero;
        $listaLimpia = $this->limpiarNull($this->listIdMedida);
        $vestimenta->medida()->sync($listaLimpia);
        $vestimenta->push();
        $this->usuario->generarBitacora("Vestimenta modificada, id: $vestimenta->id");

        $this->close();
    }
    public function close()
    {
        $this->reset(['id_vestimenta', 'nombre', 'listIdMedida', 'genero', 'id_medida','listaEditar','listaCargar']);
        $this->dispatchBrowserEvent('cerrar-modal-vista');
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->resetErrorBag();
    }
    // funciones de medida

    public function storeMedida()
    {

        $medida = Medida::create([
            'nombre' => $this->medidaNombre,
            'eliminado' => 0
        ]);
        $this->usuario->generarBitacora("Medida creada, id: $medida->id");

        $this->closeMedida();
    }

    public function loadData($id)
    {
        $medida= Medida::findOrFail($id);
        $this->idMedida = $medida->id;
        $this->medidaNombre = $medida->nombre;
    }

    public function deleteMedida()
    {
        $medida= Medida::findOrFail($this->idMedida);
        $medida->eliminado = '1';
        $medida->push();
        $this->usuario->generarBitacora("Medida eliminada, id: $medida->id");

        $this->closeMedida();
        
    }

    public function closeMedida()
    {
        $this->reset(['idMedida', 'medidaNombre']);
        $this->dispatchBrowserEvent('cerrar-modal-medida-vista');
        $this->dispatchBrowserEvent('cerrar-modal-medida-crear');
        $this->dispatchBrowserEvent('cerrar-modal-medida-eliminar');
        $this->resetErrorBag();
    }

    // funciones adicionales
    public function limpiarNull($valor)
    {
        return array_filter($valor, function ($value) {
            return $value !== null;
        });
    }
    public function EliminarLista($valor)
    {
        $clave = array_search($valor, $this->listIdMedida);
        if ($clave !== false) {
            unset($this->listIdMedida[$clave]);
}
    }
    public function totalVestimentaHombre()
    {
        return $this->listDeHabilitada->filter(function ($vestimenta) {  
            return $vestimenta->genero == 1;
        })->count();
    }
    public function totalVestimentaMujer()
    {
        return $this->listDeHabilitada->filter(function ($vestimenta) {  
            return $vestimenta->genero == 0;
        })->count();
    }


    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    
}
