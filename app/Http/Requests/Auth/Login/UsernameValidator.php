<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Login;

use Flame\Validation\Validator;

class UsernameValidator extends Validator
{
    protected array $rule = [
        'passport' => 'require|length:6,16',
        'password' => 'require|min:6|max:64',
        'captcha' => 'require|captcha',
    ];

    protected array $message = [
        'passport.require' => '登录用户名必须',
        'passport.length' => '登录用户名长度介于6-16个字符',
        'password.require' => '登录密码必须',
        'password.min' => '登录密码格式不正确',
        'password.max' => '登录密码格式不正确',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];
}
