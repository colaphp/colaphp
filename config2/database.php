<?php

return [
    // 默认使用的数据库连接配置
    'default' => env('DB_CONNECTION', 'mysql'),
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 数据库连接配置信息
    'connections' => [
        'mysql' => [
            // 数据库类型
            'type' => 'mysql',
            // 服务器地址
            'hostname' => env('DB_HOST', '127.0.0.1'),
            // 数据库名
            'database' => env('DB_DATABASE', 'force'),
            // 用户名
            'username' => env('DB_USERNAME', 'force'),
            // 密码
            'password' => env('DB_PASSWORD', ''),
            // 端口
            'hostport' => env('DB_PORT', 3306),
            // 数据库连接参数
            'params' => [],
            // 数据库编码默认采用utf8
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => 'utf8mb4_0900_ai_ci',
            // 数据库表前缀
            'prefix' => env('DB_PREFIX', ''),

            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy' => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate' => false,
            // 读写分离后 主服务器数量
            'master_num' => 1,
            // 指定从服务器序号
            'slave_no' => '',
            // 是否严格检查字段的值
            'strict' => true,
            // 是否严格检查字段是否存在
            'fields_strict' => true,
            // 是否需要断线重连
            'break_reconnect' => false,
            // 监听SQL
            'trigger_sql' => env('APP_DEBUG', false),
            // 开启字段缓存
            'fields_cache' => ! env('APP_DEBUG', false),
            // 设置 sql mode
            'modes' => [
                'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION',
            ],
        ],
    ],
];
