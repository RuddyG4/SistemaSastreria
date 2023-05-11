<?php

namespace App\Models\usuarios;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

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
        'usuario',
        'email',
        'password',
        'id_rol'
    ];

    // protected $guarded = ['id']; 

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
            get: fn (string $value) => $this->attributes['PASSWORD'] = decrypt($value),
            set: fn (string $value) => $this->attributes['password'] = bcrypt($value),
        );
    }
    // public function setPasswordAttribute($value)
    // {
    //     // esto es para usar el hash
    //     $this->attributes['password'] = Hash::make($value);
    // }

    public function persona(): BelongsTo{
        return $this->belongsTo(Persona::class,'id','id');

    }
}
