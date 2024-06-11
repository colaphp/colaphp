<?php

declare(strict_types=1);

namespace App\Http\Requests\Common;

use Flame\Validation\Validator;

class SmsValidator extends Validator
{
    protected array $rule = [
        'mobile' => 'require|mobile',
        'captcha' => 'require|captcha',
    ];

    protected array $message = [
        'mobile.require' => '手机号码必须',
        'mobile.mobile' => '手机号码格式不正确',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];
}
