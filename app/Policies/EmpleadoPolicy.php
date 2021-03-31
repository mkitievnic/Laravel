<?php

namespace App\Policies;

use App\Models\Empleado;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpleadoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Empleado $empleado)
    {
        return $user->id === $empleado->usuario->id;
    }

}
