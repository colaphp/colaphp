<?php

return [
    // 公众号
    'official_account' => [
        'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_ID', ''),
        'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', ''),
        'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', ''),
        'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),
    ],
    // 小程序
    'mini_app' => [
        'app_id' => env('WECHAT_MINI_APP_ID', ''),
        'secret' => env('WECHAT_MINI_APP_SECRET', ''),
        'token' => env('WECHAT_MINI_APP_TOKEN', ''),
        'aes_key' => env('WECHAT_MINI_APP_AES_KEY', ''),

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => true, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 5.0,
            // 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri

            'retry' => true, // 使用默认重试配置
            //  'retry' => [
            //      // 仅以下状态码重试
            //      'http_codes' => [429, 500]
            //       // 最大重试次数
            //      'max_retries' => 3,
            //      // 请求间隔 (毫秒)
            //      'delay' => 1000,
            //      // 如果设置，每次重试的等待时间都会增加这个系数
            //      // (例如. 首次:1000ms; 第二次: 3 * 1000ms; etc.)
            //      'multiplier' => 3
            //  ],
        ],
    ],

    // 微信支付
    'pay' => [
        'mch_id' => env('WECHAT_PAY_MCH_ID', ''),

        // 商户证书
        'private_key' => env('WECHAT_PAY_PRIVATE_KEY', ''),
        'certificate' => env('WECHAT_PAY_CERTIFICATE', ''),

        // v3 API 秘钥
        'secret_key' => env('WECHAT_PAY_SECRET_KEY', ''),

        // v2 API 秘钥
        'v2_secret_key' => env('WECHAT_PAY_SECRET_KEY', ''),

        // 平台证书：微信支付 APIv3 平台证书，需要使用工具下载
        // 下载工具：https://github.com/wechatpay-apiv3/CertificateDownloader
        'platform_certs' => [
            // 请使用绝对路径
            // '/path/to/wechatpay/cert.pem',
        ],

        'callback_url' => rtrim(env('APP_URL', ''), '/').'/api/common/callback/wechatPay',
        'refund_callback_url' => rtrim(env('APP_URL', ''), '/').'/api/common/callback/refundWechatPay',

        /**
         * 接口请求相关配置，超时时间等，具体可用参数请参考：
         * https://github.com/symfony/symfony/blob/5.3/src/Symfony/Contracts/HttpClient/HttpClientInterface.php
         */
        'http' => [
            'throw' => false, // 状态码非 200、300 时是否抛出异常，默认为开启
            'timeout' => 5.0,
        ],
    ],

];
