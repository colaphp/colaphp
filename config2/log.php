<?php

return [
    // 默认日志记录通道
    'default' => env('LOG_CHANNEL', 'file'),
    // 日志记录级别
    'level' => env('APP_DEBUG', false) ? [] : ['error'],
    // 日志类型记录的通道 ['error'=>'email',...]
    'type_channel' => [],
    // 关闭全局日志写入
    'close' => false,
    // 全局日志处理 支持闭包
    'processor' => null,

    // 日志通道列表
    'channels' => [
        'file' => [
            // 日志记录方式
            'type' => 'File',
            // 日志保存目录
            'path' => runtime_path('logs'),
            // 单文件日志写入
            'single' => false,
            // 独立日志级别
            'apart_level' => [],
            // 最大日志文件数量
            'max_files' => 7,
            // 使用JSON格式记录
            'json' => false,
            // 日志处理
            'processor' => null,
            // 关闭通道日志写入
            'close' => false,
            // 日志输出格式化
            'format' => '[%s][%s] %s',
            // 是否实时写入
            'realtime_write' => false,
        ],
        // 阿里云日志服务
        'sls' => [
            // 日志记录方式
            'type' => 'AliSls',
            // 阿里云 endpoint
            'endpoint' => env('SLS_ENDPOINT', ''),
            // 阿里云 AccessKey ID
            'access_key_id' => env('SLS_ACCESS_KEY_ID', ''),
            // 阿里云 AccessKey Secret
            'access_key_secret' => env('SLS_ACCESS_KEY_SECRET', ''),
            // 项目名称
            'project' => env('SLS_PROJECT', ''),
            // logstore 名称
            'logstore' => env('SLS_LOGSTORE', ''),
            // source 标识
            'source' => env('SLS_SOURCE', ''),
            // topic 标识
            'topic' => env('SLS_TOPIC', 'default'),
            // 日志处理
            'processor' => null,
            // 关闭通道日志写入
            'close' => false,
            // 使用JSON格式记录
            'json' => true,
            // 是否实时写入
            'realtime_write' => false,
        ],
        // 其它日志通道配置
    ],

];
