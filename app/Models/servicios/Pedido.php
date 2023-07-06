<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'fecha_recepcion',
        'estado_avance',
        'id_usuario',
        'id_cliente',
        'tipo',
    ];


    public function cliente() : BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
