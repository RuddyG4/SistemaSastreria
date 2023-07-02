<?php

namespace App\Http\Livewire\Usuarios;

use App\Models\usuarios\Bitacora as MBitacora;
use App\Models\usuarios\User;
use Livewire\Component;

class Bitacora extends Component
{
    public User $usuario;
    
    public function render()
    {
        return view('livewire.usuarios.bitacora', [
            'bitacoras' => MBitacora::with('usuario')->get(),
            'bitacorasHoy' => MBitacora::where('fecha_hora', '>=' , now()->toDateString()." 00:00:00")->with('usuario')->get(),
            'bitacorasSemana' => MBitacora::whereBetween('fecha_hora', [now()->subWeek(), now()])->with('usuario')->get(),
        ]);
    }

    public function mount()
    {
        $this->usuario = new User();
    }
}