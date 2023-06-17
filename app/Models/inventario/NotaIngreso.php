<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotaIngreso extends Model
{
    use HasFactory;
    protected $table = 'nota_ingreso';
    public $timestamps = false;

    public $fillable = [
        'id_usuario',
        'id_almacen',
        'fecha',
        'monto_total',
    ];

    public function detalleNota() : HasMany 
    {
        return $this->hasMany(DetalleNotaIngreso::class, 'id_nota');   
    }
}
