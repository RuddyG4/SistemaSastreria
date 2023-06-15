<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'id_medida'
    ];

    // protected $guarded = ['id'];

    public function almacen(): BelongsToMany
    {
        return $this->belongsToMany(Almacen::class, 'inventario', 'id_material', 'id_almacen')
            ->using(Inventario::class)
            ->withPivot('cantidad');
    }

    public function medida()
    {
        return $this->belongsTo(MedidaMaterial::class, 'id_medida');
    }
}
