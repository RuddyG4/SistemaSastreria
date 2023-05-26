<?php

namespace App\Models\servicios;

use App\Models\usuarios\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'direccion'
    ];
    // protected $guarded = ['id'];

    public function persona(): BelongsTo{
        return $this->belongsTo(Persona::class,'id');
    }
}
