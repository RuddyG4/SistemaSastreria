<?php

namespace App\Models\inventario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleNotaSalida extends Model
{
    use HasFactory;
    protected $table = 'detalle_nota_salida';
    public $timestamps = false;
    
    public $fillable = [
        'id_material',
        'id_nota',
        'cantidad',
    ];
    
    public function nota() : BelongsTo 
    {
        return $this->belongsTo(NotaSalida::class, 'id_nota');    
    }
    
    public function material() : BelongsTo 
    {
        return $this->belongsTo(Material::class, 'id_material');    
    }
}
