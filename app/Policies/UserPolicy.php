<?php

namespace App\Policies;

use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
        $permiso = Funcionalidad::where('nombre', 'usuario.lista')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.ver')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.crear')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.modificar')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.inhabilitar')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.habilitar')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        $permiso = Funcionalidad::where('nombre', 'usuario.inhabilitar')->first();
        return $user->rol->funcionalidades->contains($permiso);
    }
}
