<?php

return [
    'listen' => 'http://127.0.0.1:8080',
    'transport' => 'tcp',
    'context' => [],
    'name' => 'daophp',
    'count' => env('SERVER_PROCESS_COUNT', cpu_count() * 2),
    'user' => env('SERVER_PROCESS_USER', ''),
    'group' => env('SERVER_PROCESS_GROUP', ''),
    'reusePort' => false,
    'pid_file' => runtime_path() . '/app.pid',
    'status_file' => runtime_path() . '/app.status',
    'stdout_file' => runtime_path() . '/logs/stdout.log',
    'log_file' => runtime_path() . '/logs/app.log',
    'max_package_size' => 10 * 1024 * 1024
];