<?php

namespace Swift\Filesystem;

use Swift\Container\Container;
use Swift\Filesystem\Exception\StorageException;

/**
 * Class Storage
 * @package Swift\Filesystem
 */
class Storage
{
    /**
     * 本地对象存储.
     */
    public const MODE_LOCAL = 'local';

    /**
     * 阿里云对象存储.
     */
    public const MODE_OSS = 'oss';

    /**
     * 腾讯云对象存储.
     */
    public const MODE_COS = 'cos';

    /**
     * 七牛云对象存储.
     */
    public const MODE_QINIU = 'qiniu';

    /**
     * @var
     */
    protected static $adapter = null;

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return static::$adapter->{$name}(...$arguments);
    }

    /**
     * @param string $storage
     * @return void
     */
    public static function config(string $storage = self::MODE_LOCAL)
    {
        $config = config('filesystems');
        if (!isset($config['disks'][$storage]) || empty($config['disks'][$storage]['adapter'])) {
            throw new StorageException('对应的adapter不存在');
        }
        static::$adapter = Container::make($config['disks'][$storage]['adapter'], []);
    }
}
