<?php

use App\Http\Middleware\Localization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        using: function () {

            Route::middleware('web')
                ->as('client.')
                ->group(base_path('routes/web.php'));

            // Admin routes with 'admin' prefix
            Route::middleware('web')
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web([Localization::class]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin') || $request->is('admin/*')) return route('admin.auth.login');
        });

        $middleware->redirectUsersTo(function (Request $request) {
            if ($request->is('admin/*')) return route('admin.dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
