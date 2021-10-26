<?php

return [
    'listen' => 'http://0.0.0.0:8080',
    'transport' => 'tcp',
    'context' => [],
    'name' => 'daophp',
    'count' => env('SERVER_PROCESS_COUNT', cpu_count() * 2),
    'user' => env('SERVER_PROCESS_USER', ''),
    'group' => env('SERVER_PROCESS_GROUP', ''),
    'pid_file' => runtime_path() . '/app.pid',
    'stdout_file' => runtime_path() . '/logs/stdout.log',
    'log_file' => runtime_path() . '/logs/app.log',
    'max_request' => 1000000,
    'max_package_size' => 10 * 1024 * 1024
];