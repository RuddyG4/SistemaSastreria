<?php

namespace App\Models\usuarios;

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

    public function usuario(): HasOne{
        return $this->hasOne(User::class, 'id');
    }
}
