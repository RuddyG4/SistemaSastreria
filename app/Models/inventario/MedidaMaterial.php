<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedidaMaterial extends Model
{
    use HasFactory;
    protected $table = 'medida_material';
    public $timestamps = false;
    protected $fillable = [
        'tipo_medida',
        'activo'
    ];

    public function materiales()
    {
        return $this->hasMany(Materia::class, 'id_medida');
    }
}
