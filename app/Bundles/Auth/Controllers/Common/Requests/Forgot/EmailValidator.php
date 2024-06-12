<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Common\Requests\Forgot;

use Flame\Validation\Validator;

class EmailValidator extends Validator
{
    protected array $rule = [
        'email' => 'require|email',
        'captcha' => 'require|captcha',
    ];

    protected array $message = [
        'email.email' => '电子邮箱地址必须',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];
}
