<?php

declare(strict_types=1);

return [
    'paths' => [
        'migrations' => [
            base_path('database/migrations'),
            app_path('Bundles/*/Migrations'),
        ],
        'seeds' => [
            base_path('database/seeders'),
            app_path('Bundles/*/Seeders'),
        ],
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
        'development' => [
            'adapter' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'name' => env('DB_DATABASE', 'forge'),
            'user' => env('DB_USERNAME', 'forge'),
            'pass' => env('DB_PASSWORD', ''),
            'port' => env('DB_PORT', '3306'),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
        ],
    ],
    'version_order' => 'creation',
];
