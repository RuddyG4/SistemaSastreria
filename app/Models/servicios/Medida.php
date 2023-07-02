<?php

namespace App\Models\servicios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medida extends Model
{
    use HasFactory;
    protected $table = 'medida';

    public $timestamps = false;

    protected $fillable = ([
        'nombre',
        'eliminado'
    ]);

    public function vestimenta() : BelongsToMany {
        return $this->belongsToMany(Vestimenta::class, 'medida_necesaria', 'id_medida', 'id_vestimenta');
    }
}
