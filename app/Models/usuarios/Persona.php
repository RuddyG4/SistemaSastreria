<?php

namespace App\Models\usuarios;

use App\Models\servicios\Cliente;
use Database\Factories\PersonaFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'apellido',
        'ci'
    ];
    protected $guarded = ['id'];

    protected static function newFactory(): Factory
    {
        return PersonaFactory::new();
    }
    
    public function usuario(): HasOne{
        return $this->hasOne(User::class, 'id');
    }
    
    public function cliente(): HasOne{
        return $this->hasOne(Cliente::class, 'id');
    }
}

