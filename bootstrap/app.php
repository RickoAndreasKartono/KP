<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\ManagerMiddleware;
use App\Http\Middleware\KepalaAdminMiddleware;
use App\Http\Middleware\KepalaGudangMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'owner' => OwnerMiddleware::class,
            'manager' => ManagerMiddleware::class,
            'kepala_admin' => KepalaAdminMiddleware::class,
            'kepala_gudang' => KepalaGudangMiddleware::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
