<?php

declare(strict_types=1);

namespace App\Managers\DingTalk\Enums;

/**
 * 企业boss
 */
enum UserBossEnum: int
{
    /**
     * 不是
     */
    case NO = 0;

    /**
     * 是的
     */
    case Yes = 1;

}
