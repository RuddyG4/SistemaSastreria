<?php

namespace App\Models\servicios;

use App\Models\usuarios\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function vestimentas(): HasMany
    {
        return $this->hasMany(UnidadVestimenta::class, 'id_pedido');
    }

    public function fechasPago(): HasMany
    {
        return $this->hasMany(FechaPago::class, 'id_pedido');
    }
}
