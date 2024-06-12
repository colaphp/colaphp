<?php

declare(strict_types=1);

namespace App\Bundles\Article\Enums;

use Flame\Foundation\Contract\EnumMethodInterface;
use Flame\Foundation\Enums\EnumMethods;

/**
 * 文章状态
 */
enum ArticleStatusEnum: int implements EnumMethodInterface
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
