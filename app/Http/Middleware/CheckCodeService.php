<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCodeService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $serviceCode): Response
    {
        $user = auth()->user();

        $isAdmin = $user && $user->rol == 'Administrador';

        // Asegúrate de que el usuario esté autenticado y que su código de servicio coincida
        if ($isAdmin OR $user->tiposervicio->cod_service == $serviceCode) {
            return $next($request);
        }

        // Redirige al usuario si no tiene el código de servicio correcto
        return redirect(abort(401));
    }
}
