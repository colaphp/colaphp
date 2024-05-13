<?php

declare(strict_types=1);

namespace App\Bundles\User\Enums;

use Flame\Foundation\Contract\EnumMethodInterface;
use Flame\Foundation\Enums\EnumMethods;

/**
 * 用户状态
 */
enum UserStatusEnum: int implements EnumMethodInterface
{
    use EnumMethods;

    /**
     * 正常
     */
    case Normal = 1;

    /**
     * 禁用
     */
    case Disable = 2;
}
