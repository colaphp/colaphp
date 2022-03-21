<?php

return [
    '' => [
        // Global middleware
    ],
    'Auth' => [
        App\Http\Middleware\RedirectIfAuthenticated::class,
    ],
    'Shop' => [
        App\Http\Middleware\HandleCors::class,
    ],
    'Seller' => [
        App\Http\Middleware\Authenticate::class,
        App\Http\Middleware\Authorization::class,
    ],
    'User' => [
        App\Http\Middleware\HandleCors::class,
        App\Http\Middleware\Authenticate::class,
    ],
];
