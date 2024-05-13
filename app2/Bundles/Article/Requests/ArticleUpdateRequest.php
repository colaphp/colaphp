<?php

declare(strict_types=1);

namespace App\Bundles\Article\Requests;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ArticleUpdateRequest',
    required: ['id', 'title'],
    properties: [
        new OA\Property(property: 'id', description: '文章ID', type: 'integer', example: 1),
        new OA\Property(property: 'title', description: '文章标题', type: 'string', example: 'untitle'),
    ]
)]
class ArticleUpdateRequest extends Validator
{
    protected array $rule = [
        'id' => 'require',
        'title' => 'require',
    ];

    protected array $message = [
        'id.require' => '请填写文章ID',
        'title.require' => '请填写文章标题',
    ];
}
