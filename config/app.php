<?php

return [
    'name' => env('APP_NAME', 'ColaPHP'),

    'debug' => env('APP_DEBUG', false),

    'locale' => 'zh-CN',

    'frontend_url' => env('FRONTEND_URL', 'http://localhost'),

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    'providers' => [
        Flame\Database\DatabaseProvider::class,
        Flame\Session\SessionProvider::class,
    ],

    'error_reporting' => E_ALL,
    'default_timezone' => 'Asia/Shanghai',
    'public_path' => base_path().DIRECTORY_SEPARATOR.'public',
    'runtime_path' => base_path(false).DIRECTORY_SEPARATOR.'runtime',
    'controller_reuse' => false,
];
