<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FechaPago extends Model
{
    use HasFactory;
    protected $table = 'fecha_pago';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'descripcion',
        'monto',
        'id_pedido',
        'estado',
    ];

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
}
