<?php

namespace App\Http\Livewire\Servicios;

use App\Models\servicios\Almacen;
use App\Models\servicios\Material;
use Livewire\Component;

class Materiales extends Component
{
    public $idMaterial, $unidad, $nombre, $almacen, $cantidad;
    public $example;
    PUBLIC $listAlma, $listMaterial, $listPivot;
    public function render()
    {
        // query para obtener la lista de almacenes para el modal :crear:   
        $this->listAlma = Almacen::get();

        // query para la tabla  
        $this->listMaterial = Material::join('inventario', 'material.id', '=', 'inventario.id_material')
        ->join('almacen', 'inventario.id_almacen', '=', 'almacen.id')
        ->selectRaw('almacen.*, almacen.nombre as nombreAlma, material.*, inventario.*')
        ->get();

        return view('livewire.inventario.materiales');
    }

    protected $rules = [
        'nombre' => 'required|',
        'unidad' => 'required|string',
        'cantidad' => 'required|numeric',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'unidad.required' => 'La unidad es obligatoria',
        'cantidad.required' => 'La cantidad es obligatoria',
        'unidad.string' => 'La unidad tiene que contener solo letras',
        'cantidad.numeric' => 'La cantidad tiene que ser un numero',
    ];
    public function store()
    {   
        $this->validate();
        $material = Material::create([
            'nombre' => $this->nombre,
            'tipo_unidad' => $this->unidad
        ]);
        $almacen_id = $this->almacen;
        $material->almacen()->attach($almacen_id, ['cantidad' => $this->cantidad]);

        $this->cerrar();
    }   

    public function delete()
    {
        $material = Material::find($this->idMaterial);
        if ($material) {
            $material->almacen()->detach();
            $material->delete($this->idMaterial);
        }
        $this->cerrar();
    }

    public function editar($materialID)
    {
        $this->idMaterial = $materialID;
        $material = Material::findOrFail($materialID);
        $this->nombre = $material->nombre;
        $this->unidad = $material->tipo_unidad;
        $Pivot = Almacen::join('inventario', 'almacen.id', '=', 'inventario.id_almacen')
        ->select('almacen.nombre', 'inventario.cantidad','almacen.id')
        ->where('inventario.id_material', $materialID)
        ->get();

        foreach ($Pivot as $p){
            $this->cantidad = $p->cantidad;
            $this->almacen = $p->id;
        }

    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|',
            'unidad' => 'required|string',
            'cantidad' => 'required|numeric',
        ]);
        $material = Material::findOrFail($this->idMaterial);
        $material->nombre = $this->nombre;
        $material->tipo_unidad = $this->unidad;
        if ($material) {
            $material->almacen()->sync([
                $this->almacen => [
                    'cantidad' => $this->cantidad
                ]
            ]);
        }
        $material->push();
        $this->cerrar();
    }

    public function cerrar()
    {    
        $this->reset(['idMaterial', 'unidad', 'nombre','almacen','cantidad']);
        $this->dispatchBrowserEvent('cerrar-modal-crear');
        $this->dispatchBrowserEvent('cerrar-modal-eliminar');
        $this->dispatchBrowserEvent('cerrar-modal-editar');
        $this->resetErrorBag();

    }

}
