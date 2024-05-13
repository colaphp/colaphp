<?php

declare(strict_types=1);

namespace App\Bundles\User\Requests;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserUpdateRequest',
    required: ['id', 'name'],
    properties: [
        new OA\Property(property: 'id', description: '用户ID', type: 'integer', example: 1),
        new OA\Property(property: 'name', description: '用户标题', type: 'string', example: 'untitle'),
    ]
)]
class UserUpdateRequest extends Validator
{
    protected array $rule = [
        'id' => 'require',
        'name' => 'require',
    ];

    protected array $message = [
        'id.require' => '请填写用户ID',
        'name.require' => '请填写用户名称',
    ];
}
