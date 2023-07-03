<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posiciones extends Model
{
    use HasFactory;

    protected $table = 'posiciones';

    public $timestamps = false;

    protected $fillable = ([
        'nombre',
        'posX',
        'posY'
    ]);
}
