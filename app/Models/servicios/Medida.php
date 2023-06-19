<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;
    protected $table = 'Medida';

    public $timestamps = false;

    protected $fillable = ([
        'nombre',
        'eliminado'
    ]);
}
