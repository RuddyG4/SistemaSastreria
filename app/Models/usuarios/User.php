<?php

namespace App\Models\usuarios;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = false;
    protected $table = 'usuario';
    protected $fillable = [
        'id',
        'username',
        'email',
        'password',
        'id_rol',
        'activo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $this->attributes['password'] = bcrypt($value),
        );
    }

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function bitacora(): HasMany
    {
        return $this->hasMany(Bitacora::class, 'id_usuario');
    }

    /** 
     * Registra una bitacora con una determinada accion
     * @param String $accion
     * @return void
    */
    public function generarBitacora($accion) : void {
        Bitacora::create([
            'accion_realizada' => $accion,
            'fecha_hora' => now(),
            'id_usuario' => $this->id,
        ]);
    }

    public function tieneFuncionalidad($funcionalidad)
    {
        // Verificar si el usuario tiene un rol asignado
        if ($this->rol) {
            // Verificar si el rol del usuario tiene la funcionalidad deseada
            return $this->rol->funcionalidades()->where('nombre', $funcionalidad)->exists();
        }

        return false;
    }
}
