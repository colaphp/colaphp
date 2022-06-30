<?php

use App\Http\Requests\Request;

return [
    'debug' => env('APP_DEBUG', false),
    'default_timezone' => 'Asia/Shanghai',
    'request_class' => Request::class,
    'default_module' => 'Web',
    'controller_suffix' => 'Controller',
    'default_themes' => 'default',

    'providers' => [
        Cola\Database\DatabaseProvider::class,
        Cola\Session\SessionProvider::class,
    ],
];
