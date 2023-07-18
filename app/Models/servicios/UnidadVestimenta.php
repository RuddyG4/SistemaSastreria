<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnidadVestimenta extends Model
{
    use HasFactory;
    protected $table = 'unidad_vestimenta';
    public $timestamps = false;

    protected $fillable = [
        'estado',
        'id_pedido',
        'id_vestimenta',
        'id_cliente',
    ];

    public function pedido() : BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function vestimenta() : BelongsTo
    {
        return $this->belongsTo(Vestimenta::class, 'id_vestimenta');
    }

    public function cliente() : BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function medidasVestimenta(): HasMany
    {
        return $this->hasMany(MedidaVestimenta::class, 'id_unidad_vestimenta');
    }
}
