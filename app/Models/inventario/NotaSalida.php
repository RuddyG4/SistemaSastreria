<?php

namespace App\Models\inventario;

use App\Models\usuarios\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotaSalida extends Model
{
    use HasFactory;
    protected $table = 'nota_salida';
    public $timestamps = false;

    public $fillable = [
        'id_usuario',
        'id_almacen',
        'descripcion',
        'fecha',
    ];

    public function detalles() : HasMany 
    {
        return $this->hasMany(DetalleNotaSalida::class, 'id_nota');   
    }

    public function usuario() : BelongsTo {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    
    public function almacen() : BelongsTo {
        return $this->belongsTo(Almacen::class, 'id_almacen');
    }
}
