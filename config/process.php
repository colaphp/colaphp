<?php

return [
    // File update detection and automatic reload
    'monitor' => [
        'handler' => \App\Process\Monitor::class,
        'reloadable'  => false,
        'constructor' => [
            // Monitor these directories
            'monitor_dir' => [
                app_path(),
                config_path(),
                base_path() . '/bootstrap',
                base_path() . '/resources',
                base_path() . '/.env',
            ],
            // Files with these suffixes will be monitored
            'monitor_extensions' => [
                'php', 'html', 'htm', 'env'
            ]
        ]
    ],
    /*'task'  => [
        'handler'  => \App\Process\Task::class
    ],
    'websocket'  => [
        'handler'  => \App\Process\Websocket::class,
        'listen' => 'websocket://0.0.0.0:8888',
        'count'  => 10,
    ],*/
];
