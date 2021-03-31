<?php

namespace App\Providers;

use App\Models\Empleado;
use App\Policies\EmpleadoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         Empleado::class => EmpleadoPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
