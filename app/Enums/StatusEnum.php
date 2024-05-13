<?php

declare(strict_types=1);

namespace App\Enums;

use Flame\Foundation\Contract\EnumMethodInterface;
use Flame\Foundation\Enums\EnumMethods;

/**
 * 状态
 */
enum StatusEnum: int implements EnumMethodInterface
{
    use EnumMethods;

    /**
     * 正常
     */
    case Normal = 1;

    /**
     * 禁用
     */
    case Disabled = 2;

    /**
     * 锁定
     */
    case Locked = 3;
}
