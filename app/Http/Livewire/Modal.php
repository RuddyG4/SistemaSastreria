<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{   
    public $show = false;

    public function showOff(){
        $this->show = false;
    }
    public function showOn(){
        $this->show = true;
    }
    public function render()
    {
        return view('livewire.modal');
    }
}
