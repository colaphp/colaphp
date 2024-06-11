<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Register;

use Flame\Validation\Validator;

class EmailValidator extends Validator
{
    protected array $rule = [
        'email' => 'require|email',
        'password' => 'require|min:6|max:64',
        'captcha' => 'require|captcha',
    ];

    protected array $message = [
        'email.email' => '电子邮箱地址必须',
        'password.require' => '登录密码必须',
        'password.min' => '登录密码格式不正确',
        'password.max' => '登录密码格式不正确',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];
}
