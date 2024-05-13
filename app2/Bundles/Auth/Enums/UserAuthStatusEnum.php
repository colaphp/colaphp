<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Enums;

/**
 * 认证状态
 */
enum UserAuthStatusEnum: int
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
