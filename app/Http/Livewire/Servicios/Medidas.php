<?php

namespace App\Http\Livewire\Servicios;

use Livewire\Component;
use App\Models\servicios\Medida;
use Livewire\WithPagination;
class Medidas extends Component
{
    use WithPagination;
    public $busqueda, $nombre,$id_medida,$nombreEdit;
    public function render()
    {
        return view('livewire..servicios.medidas',[
            'listMedidas' => Medida::where('nombre', 'LIKE', "%$this->busqueda%")
            ->where('eliminado', 0)
            ->paginate(7)
        ]);
    }
    public function store()
    {
        Medida::create([
            'nombre' => $this->nombre
        ]);

        $this->close();
        
    }

    public function delete($id)
    {
        $medida = Medida::findOrFail($id);
        $medida->eliminado = '1';
        $medida->push();
    }

    public function edit($id)
    {
        $this->id_medida = $id;
        $medida = Medida::findOrFail($id);
        $this->nombreEdit = $medida->nombre;
    }

    public function close()
    {
        $this->reset(['id_medida', 'nombre','nombreEdit']);
    }

    public function update()
    {
        $medida = Medida::findOrFail($this->id_medida);
        $medida->nombre = $this->nombreEdit;
        $medida->push();
        $this->close();

    }
}
