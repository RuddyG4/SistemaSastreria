<?php

namespace App\Http\Livewire\Inventario;

use App\Models\inventario\Material;
use App\Models\inventario\MedidaMaterial;
use App\Models\usuarios\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Materiales extends Component
{
    use WithPagination;
    public $busqueda, $idMaterial, $nombre, $medida, $mensaje;
    public User $usuario;
    public $idMedida, $nombreMedida;
    public $example;
    public $listMedida, $listPivot, $medidas;

    public function render()
    {
        // query para obtener la lista de almacenes para el modal :crear:   
        $this->listMedida = MedidaMaterial::where('activo', 0)->get();

        return view('livewire.inventario.materiales', [
            'materiales' => Material::join('medida_material', 'material.id_medida', '=', 'medida_material.id')
                ->select('material.*', 'medida_material.tipo_medida')
                ->where('nombre', 'like', "%$this->busqueda%")
                ->paginate(12),
        ]);
    }

    protected $rules = [
        'nombre' => 'required|',
        'unidad' => 'required|',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'unidad.required' => 'La unidad es obligatoria',
    ];
    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'medida' => 'required',
        ]);
        $material = Material::create([
            'nombre' => $this->nombre,
            'id_medida' => $this->medida
        ]);
        $this->usuario->generarBitacora("Material creado, id: $material->id");
        $this->cerrar();
    }

    public function delete()
    {
        $material = Material::find($this->idMaterial);
        if ($material) {
            $material->delete($this->idMaterial);
            $this->usuario->generarBitacora("Material eliminado, id: $material->id");
        }
        $this->cerrar();
    }

    public function editar($materialID)
    {
        $this->idMaterial = $materialID;
        $material = Material::findOrFail($materialID);
        $this->nombre = $material->nombre;
        $this->medida = $material->id_medida;
    }

    public function update()
    {
        $datos = $this->validate([
            'nombre' => 'required',
            'medida' => 'required',
        ]);
        $material = Material::findOrFail($this->idMaterial);
        $material->update($datos);
        $this->usuario->generarBitacora("Material modificado, id: $material->id");
        $this->cerrar();
    }

    public function mount()
    {
        $this->medida = '1';
        $this->usuario = Auth::user();
    }
    public function cerrar()
    {
        $this->reset(['idMaterial', 'nombre', 'medida']);
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->resetErrorBag();
    }

    // funciones de los modales de medidas
    public function storeMedida()
    {
        $this->validate([
            'nombreMedida' => 'required',
        ]);

        $registro = MedidaMaterial::where('tipo_medida', $this->nombreMedida)->pluck('id');

        if ($registro->isNotEmpty()) {
            $idExistente = $registro[0];
            $medida = MedidaMaterial::findOrFail($idExistente);
            $medida->activo = 0;
            $medida->push();
        } else {
            MedidaMaterial::create([
                'tipo_medida' => $this->nombreMedida,
            ]);
        }




        // $nombreExistente = Medida_Material::where('tipo_medida', $this->nombreMedida)->exists();

        // if ($nombreExistente)
        // {
        //     $medida= Medida_Material::findOrFail($nombreExistente->id);
        //     $medida->activo = 1;
        // }else
        // {
        //     Medida_Material::create([
        //         'tipo_medida' => $this->nombreMedida,
        //     ]);
        // }


        $this->cerrarMedida();
    }

    public function DarBaja()
    {
        $medida = MedidaMaterial::findOrFail($this->idMedida);
        $medida->activo = 1;

        $medida->push();
        $this->cerrarMedida();
    }


    public function cerrarMedida()
    {
        $this->reset(['idMedida', 'nombreMedida']);
        $this->dispatchBrowserEvent('cerrar-modal-medida');
        $this->dispatchBrowserEvent('cerrar-modal-crear-medida');
        $this->dispatchBrowserEvent('cerrar-modal-baja-medida');
        $this->resetErrorBag();
    }

    public function updatingBusqueda()
    {
        $this->resetPage();
    }
}
