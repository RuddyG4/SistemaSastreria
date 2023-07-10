<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table = 'detalle_pedido';
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'id_pedido',
        'id_vestimenta'
    ];

    public function pedido() : BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
    
    public function vestimenta() : BelongsTo
    {
        return $this->belongsTo(Vestimenta::class, 'id_vestimenta');
    }
}
