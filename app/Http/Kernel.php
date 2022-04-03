<?php

namespace App\Http;

/**
 * Class Kernel
 * @package App\Http
 */
class Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    public static array $middleware = [
        \Swift\Http\Middleware\HandleCors::class,
        \Swift\Routing\Middleware\ThrottleRequests::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    public static array $middlewareGroups = [
        'Auth' => [
            \App\Http\Middleware\RedirectIfAuthenticated::class,
        ],
        'Console' => [
            \App\Http\Middleware\Authenticate::class,
            \App\Http\Middleware\Authorization::class,
        ],
        'User' => [
            \App\Http\Middleware\Authenticate::class,
        ],
    ];
}
