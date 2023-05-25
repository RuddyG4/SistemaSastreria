<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Funcionalidad;
use Livewire\Component;

class Funcionalidades extends Component
{
    public $busqueda, $nombre, $descripcion, $id_funcionalidad;

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'descripcion.required' => 'La descripcion es obligatoria',
    ];
    
    public function render()
    {
        return view('livewire.usuarios.funcionalidades',
        [
            'funcionalidades' => Funcionalidad::Where('nombre', 'LIKE', "%$this->busqueda%")
                ->get(),
        ]);
    }




}
