<?php

use Flame\Session\RedisSessionHandler;
use Flame\Support\Str;

return [
    'type' => 'redis', // or file

    'handler' => RedisSessionHandler::class,

    'config' => [
        'file' => [
            'save_path' => runtime_path('sessions'),
        ],
        'redis' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'port' => env('REDIS_PORT', '6379'),
            'auth' => env('REDIS_PASSWORD'),
            'timeout' => env('REDIS_TIMEOUT', 2),
            'database' => env('REDIS_SESSION_DB', '3'),
            'prefix' => env('REDIS_SESSION_PREFIX', Str::slug(env('APP_NAME', 'ColaPHP'), '_').'_session_'),
        ],
    ],

    'session_name' => 'SESSION_ID',

    'auto_update_timestamp' => false,

    'lifetime' => 7 * 24 * 60 * 60,

    'cookie_lifetime' => 365 * 24 * 60 * 60,

    'cookie_path' => '/',

    'domain' => '',

    'http_only' => true,

    'secure' => false,

    'same_site' => '',

    'gc_probability' => [1, 1000],
];
