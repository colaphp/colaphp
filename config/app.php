<?php

declare(strict_types=1);

use App\Http\Requests\Request;

return [
    'debug' => env('APP_DEBUG', false),
    'default_timezone' => 'Asia/Shanghai',
    'request_class' => Request::class,
    'default_themes' => 'default',

    'providers' => [
        // Cola\Database\DatabaseProvider::class,
        Cola\Session\SessionProvider::class,
    ],
];
