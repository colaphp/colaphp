<?php

use Flame\Support\Str;

return [
    'default' => env('CACHE_DRIVER', 'redis'),

    'stores' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],
    ],

    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'ColaPHP'), '_').'_cache_'),
];
