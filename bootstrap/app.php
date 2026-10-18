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
    ->withMiddleware(function (Middleware $middleware): void {
        // Visitors without a login who hit an admin URL are sent to the home page (the secret login URL stays hidden)
        $middleware->redirectGuestsTo(fn () => url('/'));
        // Logged-in users who open the login page are sent to the dashboard
        $middleware->redirectUsersTo(fn () => url('/my-dashboard'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
