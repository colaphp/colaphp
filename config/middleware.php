<?php

return [
    '' => [
        // Global middleware
        Cola\Http\Middleware\HandleCors::class,
    ],
    'Auth' => [
        App\Http\Middleware\RedirectIfAuthenticated::class,
    ],
    'Shop' => [
    ],
    'Seller' => [
        App\Http\Middleware\Authenticate::class,
        App\Http\Middleware\Authorization::class,
    ],
    'User' => [
        App\Http\Middleware\Authenticate::class,
    ],
];
