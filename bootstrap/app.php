<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // -- Aquí es donde debes agregar tu middleware de ruta personalizado --
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Si necesitas añadir middlewares a grupos web o api existentes, irían aquí.
        // Por ejemplo, si quisieras que tu AdminMiddleware se ejecutara en todas las rutas web por defecto:
        // $middleware->web(append: [
        //     \App\Http\Middleware\AdminMiddleware::class,
        // ]);
        // PERO PARA TU CASO ES MEJOR EL ALIAS PARA APLICARLO EN GRUPOS DE RUTAS ESPECÍFICOS.

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();