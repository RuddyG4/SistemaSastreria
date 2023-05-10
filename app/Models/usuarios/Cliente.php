<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    public $timestamps = false;
    protected $fillable = [
        'direccion'
    ];
    protected $guarded = ['id'];

    public function persona(): BelongsTo{
        return $this->belongsTo(Persona::class,'id','id');
    }
}
