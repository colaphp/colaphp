<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => ['aliyun'],
    ],

    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => runtime_path('logs/sms.log'),
        ],
        'aliyun' => [
            'access_key_id' => env('ALI_SMS_KEY',  ''),
            'access_key_secret' => env('ALI_SMS_SECRET',  ''),
            'sign_name' => env('ALI_SMS_SIGN',  ''),
        ],
    ],
];
