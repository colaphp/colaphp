<?php

namespace Swift\Filesystem\Traits;

trait StaticErrorMsg
{
    /**
     * @var string
     */
    public static string $message = 'success';

    /**
     * @param bool $success
     * @param string $message
     * @return bool
     */
    public static function setStaticError(bool $success, string $message): bool
    {
        self::$message = $message;
        return $success;
    }

    /**
     * @return string
     */
    public static function getStaticMessage(): string
    {
        return self::$message;
    }
}
