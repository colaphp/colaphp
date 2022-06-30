<?php

namespace Swift\Queue\Redis;

use Workerman\RedisQueue\Client as RedisClient;

/**
 * Class Client
 * @method static void send($queue, $data, $delay=0)
 * @package Swift\Queue\Redis
 */
class Client
{
    /**
     * @var Client[]
     */
    protected static $_connections = null;

    /**
     * @param string $name
     * @return RedisClient
     */
    public static function connection($name = 'default') {
        if (!isset(static::$_connections[$name])) {
            $config = config('queue.redis', []);
            if (!isset($config[$name])) {
                throw new \RuntimeException("Redis Queue connection $name not found");
            }
            $host = $config[$name]['host'];
            $options = $config[$name]['options'];
            $client = new RedisClient($host, $options);
            static::$_connections[$name] = $client;
        }
        return static::$_connections[$name];
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::connection('default')->{$name}(... $arguments);
    }
}
