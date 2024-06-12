<?php

use Flame\Session\RedisSessionHandler;

return [
    'type' => 'redis', // or file

    'handler' => RedisSessionHandler::class,

    'config' => [
        'file' => [
            'save_path' => runtime_path('sessions'),
        ],
        'redis' => [
            'host' => '127.0.0.1',
            'port' => 6379,
            'auth' => '',
            'timeout' => 2,
            'database' => '',
            'prefix' => 'redis_session_',
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
