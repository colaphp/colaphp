<?php

declare(strict_types=1);

namespace App\Bundles\Sms\Constants;

class SmsConst
{
    /**
     * 短信模块缓存前缀
     */
    const SMS_CACHE_PREFIX = 'sms_';

    /**
     * 短信缓存有效时间
     */
    const SMS_CACHE_EXPIRE = 10 * 60;
}
