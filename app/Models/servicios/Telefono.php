<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Telefono extends Model
{
    use HasFactory;
    protected $table = 'telefono';
    public $timestamps = false;
    protected $fillable = [
        'numero',
        'tipo',
        'id_cliente',
    ];

    public function cliente() : BelongsTo 
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
