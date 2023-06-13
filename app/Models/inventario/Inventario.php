<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Inventario extends Pivot
{
    use HasFactory;
    
    protected $table = 'inventario';
    public $timestamps = false;
    public $fillable = [
        'id_almacen',
        'id_material',
        'cantidad'
    ];

}
