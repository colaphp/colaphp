<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Admin\Requests\DingTalk;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'DingTalkLoginRequest',
    required: ['code'],
    properties: [
        new OA\Property(property: 'code', description: '钉钉code', type: 'string', example: 'abc'),
    ]
)]
class DingTalkLoginRequest extends Validator
{
    protected array $rule = [
        'code' => 'require',
    ];

    protected array $message = [
        'code.require' => '请输入钉钉code',
    ];
}
