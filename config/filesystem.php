<?php

return [
    // 默认磁盘
    'default' => env('FILESYSTEM_DISK', 'local'),
    // 本地磁盘
    'local' => [
        'storage_type' => 'File',
        'root' => public_path('storage'),
        'asset_url' => env('APP_URL', 'http://localhost').'/storage', // 公网可访问的自定义域名
    ],
    // 阿里云OSS
    'oss' => [
        'storage_type' => 'AliOSS',
        'access_key_id' => env('OSS_ACCESS_KEY_ID', ''), // OSS Key
        'access_key_secret' => env('OSS_ACCESS_KEY_SECRET', ''), // OSS Secret
        'bucket' => env('OSS_BUCKET', ''), // OSS Bucket
        'endpoint' => env('OSS_ENDPOINT', ''), // 选定的OSS数据中心访问域名，例如oss-cn-hangzhou.aliyuncs.com
        'asset_url' => env('ASSET_URL', 'http://localhost'), // 公网可访问的自定义域名
    ],
];
