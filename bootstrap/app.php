<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
        if(app()->environment('production')) {
            $exceptions->respond(function (Response|RedirectResponse $response) use ($exceptions) {
                if ($exceptions instanceof NotFoundHttpException) {
                    return response()->redirectTo('/');
            }

            if($exceptions instanceof InternalErrorException) {
                Log::error($exceptions->getMessage());
                 return throw $exceptions;
                }

                return response()->redirectTo('/');
            });
        }
    })->create();
