<?php

declare(strict_types=1);

return [
    // File update detection and automatic reload
    'monitor' => [
        'handler' => \App\Process\Monitor::class,
        'reloadable' => false,
        'constructor' => [
            // Monitor these directories
            'monitor_dir' => [
                app_path(),
                config_path(),
                base_path('bootstrap'),
                base_path('resources'),
                base_path('.env'),
            ],
            // Files with these suffixes will be monitored
            'monitor_extensions' => [
                'php', 'html', 'htm', 'env',
            ],
        ],
    ],
    /*'task'  => [
        'handler'  => \App\Process\Task::class
    ],
    'websocket'  => [
        'handler'  => \App\Process\Websocket::class,
        'listen' => 'websocket://0.0.0.0:8888',
        'count'  => 10,
    ],
    'rpc'  => [
        'handler' => \App\Process\Rpc::class,
        'listen'  => 'text://0.0.0.0:8888', // 这里用了text协议，也可以用frame或其它协议
        'count'   => 8, // 可以设置多进程
    ]*/
];
