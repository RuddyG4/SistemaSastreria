<?php

namespace App\Http\Livewire\Inventario;

use App\Models\inventario\Almacen;
use App\Models\inventario\Inventario as MInventario;
use App\Models\inventario\Material;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;

class Inventario extends Component
{
    public $busqueda, $almacen;
    public $notas, $id_material, $cantidad, $precio;

    public function render()
    {
        $almacenes = Almacen::all();
        if ($almacenes->isEmpty()) {
            return view('livewire.inventario.inventario');
        } else {
            $this->almacen = $almacenes->first();
            return view('livewire.inventario.inventario', [
                'almacenes' => $almacenes,
                'materiales' => Material::all(),
                'datos' => MInventario::Where('id_almacen', $this->almacen->id)->whereHas('material', function(Builder $query) {
                    $query->where('nombre', 'like', "%$this->busqueda%");
                })->get(),
                // 'datos' => MInventario::Where('id_almacen', $this->almacen->id)->get(),
            ]);
        }
    }
}
