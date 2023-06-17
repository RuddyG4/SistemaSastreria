<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleNotaIngreso extends Model
{
    use HasFactory;
    protected $table = 'detalle_nota_ingreso';
    public $timestamps = false;
    
    public $fillable = [
        'id_material',
        'cantidad',
        'precio',
    ];
    
    public function nota() : BelongsTo 
    {
        return $this->belongsTo(NotaIngreso::class, 'id_nota');    
    }
    
    public function material() : BelongsTo 
    {
        return $this->belongsTo(Material::class, 'id_material');    
    }
}
