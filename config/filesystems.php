<?php

declare(strict_types=1);

return [
    /*
     * local：本地 oss：阿里云 cos：腾讯云 qos：七牛云
     */
    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
     * 单个文件的大小限制，默认200M 1024 * 1024 * 200
     */
    'single_limit' => 1024 * 1024 * 200,

    /*
     * 所有文件的大小限制，默认200M 1024 * 1024 * 200
     */
    'total_limit' => 1024 * 1024 * 200,

    /*
     * 文件数量限制，默认10
     */
    'nums' => 10,

    /*
     * 被允许的文件类型列表
     */
    'include' => [],

    /*
     * 不被允许的文件类型列表
     */
    'exclude' => [],

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "oss", "cos", "qiniu"
    |
    */
    'disks' => [
        /*
         * 本地对象存储
         */
        'local' => [
            'adapter' => Flame\Filesystem\Adapter\LocalAdapter::class,
            'root' => runtime_path('storage'),
            'dirname' => '/storage',
            'domain' => 'http://127.0.0.1:8000',
        ],

        /*
         * 阿里云对象存储
         */
        'oss' => [
            'adapter' => Flame\Filesystem\Adapter\OssAdapter::class,
            'accessKeyId' => 'xxxxxxxxxxxx',
            'accessKeySecret' => 'xxxxxxxxxxxx',
            'bucket' => 'resty',
            'dirname' => 'storage',
            'domain' => 'https://resty.oss.com',
            'endpoint' => 'oss-cn-hangzhou.aliyuncs.com',
        ],

        /*
         * 腾讯云对象存储
         */
        'cos' => [
            'adapter' => Flame\Filesystem\Adapter\CosAdapter::class,
            'secretId' => 'xxxxxxxxxxxxx',
            'secretKey' => 'xxxxxxxxxxxx',
            'bucket' => 'resty',
            'dirname' => 'storage',
            'domain' => 'https://resty.cos.com',
            'region' => 'ap-shanghai',
        ],

        /*
         * 七牛云对象存储
         */
        'qiniu' => [
            'adapter' => Flame\Filesystem\Adapter\QiniuAdapter::class,
            'accessKey' => 'xxxxxxxxxxxxx',
            'secretKey' => 'xxxxxxxxxxxxx',
            'bucket' => 'resty',
            'dirname' => 'storage',
            'domain' => 'https://resty.qiniu.com',
        ],
    ],
];
