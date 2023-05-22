<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Boton extends Component
{

    public $nombre = 'livewire';
    public $numero = 5;
    
    public function contar()
    {
        $this->numero++;
        
    }
    public function render()
    {
        return view('livewire.boton');
    }
}
