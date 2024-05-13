<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    */

    'name' => env('APP_NAME', 'ColaPHP'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    */

    'debug' => env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | 应用的默认语言
    |--------------------------------------------------------------------------
    |
    */

    'locale' => 'zh-CN',

    /*
    |--------------------------------------------------------------------------
    | 前端地址
    |--------------------------------------------------------------------------
    |
    */

    'frontend_url' => env('FRONTEND_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    */

    'providers' => [
        Flame\Database\DatabaseProvider::class,
        Flame\Session\SessionProvider::class,
    ],
];
