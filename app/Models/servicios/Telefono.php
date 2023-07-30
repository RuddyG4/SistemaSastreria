<?php

namespace App\Models\servicios;

use Database\Factories\TelefonoFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
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

    protected static function newFactory(): Factory
    {
        return TelefonoFactory::new();
    }

    public function cliente() : BelongsTo 
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
