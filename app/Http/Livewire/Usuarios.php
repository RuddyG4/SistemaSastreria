<?php

namespace App\Http\Livewire;

use App\Models\usuarios\User;
use Livewire\Component;

class Usuarios extends Component
{
    public $busqueda;
    public User $user;
    public $modalVisible = false;
    public $usuarioEditado;
    protected $rules = [
        'user.username' => 'required|string|unique:usuarios',
        'user.email' => 'required|email|unique:usuarios',
    ];

    public function render()
    {
        return view(
            'livewire.usuarios',
            ['usuarios' => User::Where('username', 'LIKE', "%$this->busqueda%")
                ->orWhere('email', 'LIKE', "%$this->busqueda%")->get()]
        );
    }

    public function editar()
    {
        $this->usuarioEditado = $this->user->toArray();
        $this->modalVisible = true;
    }

    public function cerrarModal()
    {
        $this->modalVisible = false;
        $this->usuarioEditado = null;
    }

    public function save()
    {
        $this->validate();
        $this->user->save();
    }
}
