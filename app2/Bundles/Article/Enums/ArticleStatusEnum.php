<?php

declare(strict_types=1);

namespace App\Bundles\Article\Enums;

/**
 * 文章状态
 */
enum ArticleStatusEnum: int
{
    /**
     * 正常
     */
    case Normal = 1;

    /**
     * 禁用
     */
    case Disable = 2;
}
