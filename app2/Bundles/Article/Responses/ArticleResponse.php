<?php

declare(strict_types=1);

namespace App\Bundles\Article\Responses;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'ArticleResponse')]
class ArticleResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '文章编号', type: 'integer', example: 1)]
    private int $id;

    #[OA\Property(property: 'title', description: '文章标题', type: 'string', example: 'untitle')]
    private int $title;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(int $title): void
    {
        $this->title = $title;
    }
}
