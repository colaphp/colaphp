<?php

declare(strict_types=1);

use App\Http\Requests\Request;

return [
    'app_name' => env('APP_NAME', 'ColaPHP'),
    'debug' => env('APP_DEBUG', false),
    'default_timezone' => 'Asia/Shanghai',
    'default_module' => 'Web',
    'controller_suffix' => 'Controller',
    'default_themes' => 'default',
    'request_class' => Request::class,

    'providers' => [
        Flame\Database\DatabaseProvider::class,
        Flame\Session\SessionProvider::class,
    ],
];
