<?php

declare(strict_types=1);

return [
    'type' => 'file', // or redis or redis_cluster

    'handler' => Cola\Session\FileSessionHandler::class,

    'config' => [
        'file' => [
            'save_path' => runtime_path('sessions'),
        ],
        'redis' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'port' => env('REDIS_PORT', 6379),
            'auth' => env('REDIS_PASSWORD'),
            'timeout' => 2,
            'database' => env('REDIS_DB', '0'),
            'prefix' => 'redis_session_',
        ],
    ],

    'session_name' => 'PHPSESSID',
    'lifetime' => env('SESSION_LIFETIME', 1440),
    'path' => '/',
    'domain' => env('SESSION_DOMAIN', ''),
    'secure' => env('SESSION_SECURE_COOKIE', false),
    'http_only' => true,
    'same_site' => '',
];
