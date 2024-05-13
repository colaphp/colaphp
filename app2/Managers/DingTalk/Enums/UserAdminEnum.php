<?php

declare(strict_types=1);

namespace App\Managers\DingTalk\Enums;

/**
 * 企业管理员
 */
enum UserAdminEnum: int
{
    /**
     * 是的
     */
    case OK = 1;

    /**
     * 不是
     */
    case NO = 0;
}
