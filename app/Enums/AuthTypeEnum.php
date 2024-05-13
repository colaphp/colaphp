<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * 认证类型
 */
enum AuthTypeEnum: string
{
    /**
     * 员工
     */
    case Admin = 'admin';
}
