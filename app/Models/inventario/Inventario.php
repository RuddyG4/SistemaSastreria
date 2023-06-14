<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function material(): BelongsTo {
        return $this->belongsTo(Material::class, 'id_material');
    }

    public function almacen(): BelongsTo {
        return $this->belongsTo(Almacen::class, 'id_almacen');
    }

}
