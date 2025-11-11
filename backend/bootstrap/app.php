<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Middleware\TrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            RateLimiter::for('api', function (Request $request) {
                // Define o limite: 60 pedidos por minuto
                // por utilizador autenticado OU por endereço IP
                return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
            });
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->group('api', [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        //     \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
        //     \Illuminate\Routing\Middleware\SubstituteBindings::class,
        // ]);
        // $middleware->trustProxies(
        //      at: '*', // Confia em todos os proxies (para dev)
        //  );
        $middleware->statefulApi();

        // // Configuração explícita do CORS para o grupo 'api'
        // $middleware->prependToGroup('api', HandleCors::class);
        // // Ativa o suporte do Sanctum para cookies
        // $middleware->statefulApi();

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
