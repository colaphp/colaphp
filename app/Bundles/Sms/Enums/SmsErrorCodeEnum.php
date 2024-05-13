<?php

declare(strict_types=1);

namespace App\Bundles\Sms\Enums;

use Flame\Foundation\Contract\EnumMethodInterface;
use Flame\Foundation\Enums\EnumMethods;

enum SmsErrorCodeEnum: int implements EnumMethodInterface
{
    use EnumMethods;

    /**
     * 发送短信验证码错误
     */
    case SMS_SEND_ERROR = 10000;

    /**
     * 短信验证码不正确
     */
    case SMS_CODE_ERROR = 10001;

    /**
     * 短信验证码登录错误
     */
    case SMS_CODE_LOGIN_ERROR = 10002;
}
