<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vestimenta extends Model
{
    use HasFactory;
    protected $table = 'vestimenta';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'genero',
        'activo'
    ];

    public function medida() : BelongsToMany {
        return $this->belongsToMany(Medida::class, 'medida_necesaria', 'id_vestimenta', 'id_medida');
    }

    public function detalles() : HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_vestimenta');
    }

    public function unidadesVestimenta(): HasMany
    {
        return $this->hasMany(UnidadVestimenta::class, 'id_vestimenta');
    }
}

