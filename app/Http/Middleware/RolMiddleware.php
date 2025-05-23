<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $user = Auth::user();

        // Convertir la lista de roles en un array
        $rolesArray = explode(',', $roles);

        if ($user && $user->rolActivo() && in_array($user->rolActivo()->nombre, $rolesArray)) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado');
        /* $user = Auth::user();
        if ($user && $user->rolActivo() && $user->rolActivo()->nombre === $rol) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado'); */
    }
}
