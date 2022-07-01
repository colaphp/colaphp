<?php

namespace App\Process;

use Workerman\Connection\TcpConnection;

/**
 * Class Rpc
 * @package App\Process
 */
class Rpc
{
    public function onMessage(TcpConnection $connection, $data)
    {
        static $instances = [];
        $data = json_decode($data, true);
        $class = 'App\\Services\\' . $data['class'];
        $method = $data['method'];
        $args = $data['args'];
        if (!isset($instances[$class])) {
            // 缓存类实例，避免重复初始化
            $instances[$class] = new $class();
        }
        $connection->send(call_user_func_array([$instances[$class], $method], $args));
    }
}
