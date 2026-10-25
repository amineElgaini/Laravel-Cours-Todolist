<?php

use App\Http\Middleware\EnsureTaskOwner;
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
        // Give our custom middleware a short name
        $middleware->alias([
            'task.owner' => EnsureTaskOwner::class,
        ]);

        // Where to send a logged-in user who opens /login or /register
        $middleware->redirectUsersTo(fn () => route('tasks.index'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
