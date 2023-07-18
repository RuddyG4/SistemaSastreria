<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedidaVestimenta extends Model
{
    use HasFactory;

    protected $table = 'medida_vestimenta';
    public $timestamps = false;
    protected $fillable = [
        'valor',
        'id_unidad_vestimenta',
        'id_medida',
    ];

    public function unidadVestimenta(): BelongsTo
    {
        return $this->belongsTo(UnidadVestimenta::class, 'id_unidad_vestimenta');
    }

    public function medida(): BelongsTo
    {
        return $this->belongsTo(Medida::class, 'id_medida');
    }
}
