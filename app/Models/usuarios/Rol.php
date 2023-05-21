<?php

namespace App\Models\usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rol';
    public $timestamps = false;
    protected $fillable = [
        'nombre'
    ];
    protected $guarded = ['id'];

    public function funcionalidades() : BelongsToMany {
        return $this->belongsToMany(Funcionalidad::class, 'permiso_rol', 'id_rol', 'id_funcionalidad');
    }

    public function usuarios() : HasMany
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
