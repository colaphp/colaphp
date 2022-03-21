<?php

return [
    'enable' => env('APP_DEBUG', false),
    'middleware' => [
        App\Http\Middleware\StaticFile::class,
    ],
];
