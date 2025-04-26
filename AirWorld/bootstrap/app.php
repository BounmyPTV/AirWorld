<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(App\Http\Middleware\CheckAdmin::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Ajout page erreur
        $exceptions->render(function (Throwable $e) {
            if ($e instanceof HttpExceptionInterface) {
                // On mets response->view si on mets que view, le code erreur 
                // sera 200 et pour la logique du site, c'est pas bon.
                return response()->view('error', ['code' => $e->getStatusCode()], $e->getStatusCode());
            }
        });
    })->create();
    
