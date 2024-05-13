<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Requests\Auth;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'LoginMobileRequest',
    required: ['mobile', 'password', 'captcha', 'uuid'],
    properties: [
        new OA\Property(property: 'mobile', description: '手机号码', type: 'string', example: '13901889999'),
        new OA\Property(property: 'password', description: '登录密码', type: 'string', example: '123456aA'),
        new OA\Property(property: 'captcha', description: '图片验证码', type: 'string', example: '1234'),
        new OA\Property(property: 'uuid', description: '图片验证码UUID参数', type: 'string', example: '1234'),
    ]
)]
class LoginMobileRequest extends Validator
{
    protected array $rule = [
        'mobile' => 'require|mobile',
        'password' => 'require|min:6',
        'captcha' => 'require|captcha',
        'uuid' => 'require',
    ];

    protected array $message = [
        'mobile.require' => '请输入登录手机号',
        'mobile.mobile' => '手机号码格式不符合',
        'password.require' => '请输入登录密码',
        'password.min' => '短信验证码不符合',
        'captcha.require' => '请输入图片验证码',
        'captcha.captcha' => '图片验证码不正确',
        'uuid.require' => '请输入uuid参数',
    ];
}
