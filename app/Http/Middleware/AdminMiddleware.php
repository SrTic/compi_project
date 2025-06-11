<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // <-- ¡Asegúrate de importar la fachada Log!

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // --- LÍNEA DE DEPURACIÓN: Añadimos un log aquí ---
        Log::info('AdminMiddleware ejecutado para la ruta: ' . $request->path());
        // --- FIN LÍNEA DE DEPURACIÓN ---

        if (Auth::check() && Auth::user()->rol === 'administrador') {
            Log::info('Usuario ' . Auth::user()->email . ' es administrador. Acceso concedido.'); // Log de éxito
            return $next($request);
        }

        Log::warning('Intento de acceso denegado a ruta de admin. Usuario: ' . (Auth::check() ? Auth::user()->email : 'No logueado')); // Log de denegación
        return redirect('/dashboard')->with('error', 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
    }
}