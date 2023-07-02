<?php

namespace App\Http\Livewire\Servicios;

use Livewire\Component;
use App\Models\servicios\Posiciones;

class Cuadro extends Component
{
    public $valorX, $valorY, $mensaje;
    public $nueva;
    public $currentPositions = [];

    protected $listeners = ['guardarPosiciones'];

    public function render()
    {
        $this->nueva = Posiciones::get();
        return view('livewire.servicios.cuadro');
    }

    public function mount()
    {
        $this->valorX = 365;
        $this->valorY = 420;
    }

    public function guardarPosiciones($datos)
    {
        foreach ($datos as $elementId => $position) {
            $elemento = Posiciones::find($elementId);
            if ($elemento) {
                $elemento->posX = $position['posX'];
                $elemento->posY = $position['posY'];
                $elemento->save();
            }
        }
    }
}
