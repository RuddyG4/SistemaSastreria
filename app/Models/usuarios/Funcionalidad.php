<?php

namespace App\Models\usuarios;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Funcionalidad extends Model
{
    use HasFactory;
    protected $table = 'funcionalidad';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    protected $guarded = ['id'];

    public function roles() : BelongsToMany {
        return $this->belongsToMany(Rol::class, 'permiso_rol', 'id_funcionalidad', 'id_rol');
    }
}
