<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
