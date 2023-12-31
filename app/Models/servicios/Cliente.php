<?php

namespace App\Models\servicios;

use App\Models\usuarios\Persona;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    public $timestamps = false;
    protected $fillable = [
        'direccion'
    ];
    protected $guarded = ['id'];

    protected static function newFactory(): Factory
    {
        return ClienteFactory::new();
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id');
    }

    public function telefonos(): HasMany
    {
        return $this->hasMany(Telefono::class, 'id_cliente');
    }

    public function telefonoPersonal(): HasOne
    {
        return $this->hasOne(Telefono::class, 'id_cliente')->where('tipo', 0);
    }

    public function unidadesVestimenta(): HasMany
    {
        return $this->hasMany(UnidadVestimenta::class, 'id_cliente');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}
