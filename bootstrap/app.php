<?php

use App\Http\Middleware\ConvertEmptyStringsToNull as CustomConvertEmptyStringsToNull;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->throttleApi();
        $middleware->trustProxies(['127.0.0.1']);
        $middleware->replace(ConvertEmptyStringsToNull::class, CustomConvertEmptyStringsToNull::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
