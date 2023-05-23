<?php

namespace App\Http\Livewire;

use App\Models\usuarios\User;
use Livewire\Component;

class Usuarios extends Component
{
    public $busqueda;
    public function render()
    {
        return view('livewire.usuarios',
        ['usuarios' => User::Where('username', 'LIKE', "%$this->busqueda%")
                    ->orWhere('email', 'LIKE', "%$this->busqueda%")->get()]);
    }
}
