<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vestimenta extends Model
{
    use HasFactory;
    protected $table = 'vestimenta';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'genero',
        'activo'
    ];
}
