<?php

namespace App\Http\Middleware;

use Closure;

class CheckNivel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $niveles = array_slice(func_get_args(), 2);
        if(auth()->user()->hasNiveles($niveles))
        {
            return $next($request);
        }
        return response()->view("errors.403", [], 403);
    }
}
