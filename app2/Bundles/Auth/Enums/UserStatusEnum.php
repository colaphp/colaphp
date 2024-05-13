<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Enums;

/**
 * 状态
 */
enum UserStatusEnum: int
{
    /**
     * 正常
     */
    case Normal = 1;

    /**
     * 禁用
     */
    case Disabled = 2;
}
