<?php

declare(strict_types=1);

namespace App\Bundles\Auth\API\User\Requests\Wechat;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'WechatLoginRequest',
    required: [
        'login_code',
        'phone_code',
    ],
    properties: [
        new OA\Property(property: 'login_code', description: '用户登录凭证，在小程序登录时获取的 code，可通过wx.login获取', type: 'string', example: 'example...'),
        new OA\Property(property: 'phone_code', description: '手机号获取凭证，通过手机号实时验证组件', type: 'string', example: 'example...'),
    ]
)]
class WechatLoginRequest extends Validator
{
    protected array $rule = [
        'login_code' => 'require',
        'phone_code' => 'require',
    ];

    protected array $message = [
        'login_code.require' => '请设置用户登录凭证',
        'phone_code.require' => '请设置手机号获取凭证',
    ];
}
