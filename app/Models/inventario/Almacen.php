<?php

namespace App\Models\inventario;

use App\Models\inventario\Inventario;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Almacen extends Model
{
    use HasFactory;

    protected $table = 'almacen';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'ubicacion'
    ];

    // protected $guarded = ['id'];

    public function material(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'inventario', 'id_almacen', 'id_material')
            ->using(Inventario::class)
            ->withPivot('cantidad');
    }
}
