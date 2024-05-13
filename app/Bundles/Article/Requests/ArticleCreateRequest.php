<?php

declare(strict_types=1);

namespace App\Bundles\Article\Requests;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ArticleCreateRequest',
    required: ['title'],
    properties: [
        new OA\Property(property: 'title', description: '文章标题', type: 'string', example: 'untitle'),
    ]
)]
class ArticleCreateRequest extends Validator
{
    protected array $rule = [
        'title' => 'require',
    ];

    protected array $message = [
        'title.require' => '请填写文章标题',
    ];
}
