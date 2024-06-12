<?php

use Overtrue\EasySms\Strategies\OrderStrategy;

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => ['aliyun'],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => runtime_path('logs/sms.log'),
        ],
        'aliyun' => [
            'access_key_id' => env('SMS_ACCESS_KEY_ID', ''),
            'access_key_secret' => env('SMS_ACCESS_KEY_SECRET', ''),
            'sign_name' => env('SMS_SIGN_NAME', ''),
        ],
        'qcloud' => [
            'sdk_app_id' => env('QCLOUD_SDK_APP_ID', ''), // 短信应用的 SDK APP ID
            'secret_id' => env('QCLOUD_SECRET_ID', ''), // SECRET ID
            'secret_key' => env('QCLOUD_SECRET_KEY', ''), // SECRET KEY
            'sign_name' => env('QCLOUD_SIGN_NAME', ''), // 短信签名
        ],
    ],
    // 信息模板
    'templates' => [
        'SMS_CODE' => ['SMS_276426190' => '您的验证码为: ${code}，请勿泄露于他人!'],
        // ...
    ],
];
