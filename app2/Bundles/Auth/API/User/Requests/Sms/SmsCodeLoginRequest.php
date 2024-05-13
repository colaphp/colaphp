<?php

declare(strict_types=1);

namespace App\Bundles\Auth\API\User\Requests\Sms;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SmsCodeLoginRequest',
    required: ['mobile', 'sms_code', 'login_code'],
    properties: [
        new OA\Property(property: 'mobile', description: '手机号码', type: 'string', example: '13901889999'),
        new OA\Property(property: 'sms_code', description: '短信验证码', type: 'string', example: '1234'),
        new OA\Property(property: 'login_code', description: '用户登录凭证，在小程序登录时获取的 code，可通过wx.login获取', type: 'string', example: 'example...'),
    ]
)]
class SmsCodeLoginRequest extends Validator
{
    protected array $rule = [
        'mobile' => 'require|mobile',
        'sms_code' => 'require',
        'login_code' => 'require',
    ];

    protected array $message = [
        'mobile.require' => '请输入登录手机号',
        'mobile.mobile' => '手机号码格式不符合',
        'sms_code.require' => '请输入短信验证码',
        'login_code.require' => '请输入登录凭证',
    ];
}
