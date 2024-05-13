<?php

declare(strict_types=1);

namespace App\Bundles\User\Requests;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserCreateRequest',
    required: ['name'],
    properties: [
        new OA\Property(property: 'name', description: '名称', type: 'string', example: 'untitle'),
    ]
)]
class UserCreateRequest extends Validator
{
    protected array $rule = [
        'name' => 'require',
    ];

    protected array $message = [
        'name.require' => '请填写名称',
    ];
}
