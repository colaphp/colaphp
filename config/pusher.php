<?php

declare(strict_types=1);

use Flame\Pusher\PusherServer;

return [
    'server' => [
        'handler' => PusherServer::class,
        'listen' => 'websocket://127.0.0.1:2347',
        'count' => 1, // 必须是1
        'reloadable' => false, // 执行reload不重启
        'constructor' => [
            'api_listen' => 'http://127.0.0.1:2348', // 服务端推送地址
            'app_info' => [
                env('PUSH_APP_KEY') => [
                    'app_secret' => env('PUSH_APP_SECRET', ''),
                    'channel_hook' => env('APP_URL').'/push/hook',
                ],
            ],
        ],
    ],
];
