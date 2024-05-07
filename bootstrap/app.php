<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append : [

            //            App\Http\Middleware\ChooseFamilyMiddleware::class,
            //            App\Http\Middleware\CheckNewFamilyMemberRole::class,
            App\Http\Middleware\Localization::class,
            App\Http\Middleware\SetLocale::class,
            //            App\Http\Middleware\SubdomainMiddleware::class,
            App\Http\Middleware\LogAllRequests::class,

        ]);
        $middleware->alias([

            'check.newfamilymember' => \App\Http\Middleware\CheckNewFamilyMemberRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //

//        $exceptions->render(function (Throwable $exception, Request $request) {
//
//            if (app()->isProduction() && !$exception instanceof  \Illuminate\Validation\ValidationException ) {
//
//
//                $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
//
////                dd($exception , $exception instanceof  \Illuminate\Validation\ValidationException    ,$exception->getCode() ,$status);
//                $error = method_exists($exception, 'getError') ? $exception->getError() : 'Server Error';
//                $message = $exception->getMessage();
////                                        dd($message ,$status ,$exception);
//                if ($status == 419 && $exception->getCode() !== 0) {
//                    $error = 'Session Expired';
//                    $message = 'Your session has expired. Please refresh the page and try again.';
//                }
//
//                if ($status == 403 && $exception->getCode() !== 0) {
//                    $error = 'Forbidden Access';
//                    $message = 'Your session has expired. Please refresh the page and try again.';
//                }
//
//                return response()->view('errors.error', [
//                    'status' => $status,
//                    'error' => $error,
//                    'message' => $message,
//                ], $status);
//
//            }
////            dd($exceptions);
//        });

    })->create();
