<?php

declare(strict_types=1);

namespace App\Http;

/**
 * Class Kernel
 */
class Kernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    public static array $middleware = [
        \Cola\Http\Middleware\HandleCors::class,
        \Cola\Routing\Middleware\ThrottleRequests::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
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
        'Web' => [
            \App\Http\Middleware\VerifyCsrfToken::class,
        ],
    ];
}
