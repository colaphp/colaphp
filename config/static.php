<?php

declare(strict_types=1);

return [
    'enable' => env('APP_DEBUG', false),
    'middleware' => [
        App\Http\Middleware\StaticFile::class,
    ],
];
