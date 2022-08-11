<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Login;

use App\Services\Captcha\CaptchaService;
use Cola\Validation\Validator;

/**
 * Class UsernameValidator
 */
class UsernameValidator extends Validator
{
    /**
     * @var array
     */
    protected $rule = [
        'passport' => 'require|length:6,16',
        'password' => 'require|min:6|max:64',
        'captcha' => 'require|captcha',
    ];

    /**
     * @var array
     */
    protected $message = [
        'passport.require' => '登录用户名必须',
        'passport.length' => '登录用户名长度介于6-16个字符',
        'password.require' => '登录密码必须',
        'password.min' => '登录密码格式不正确',
        'password.max' => '登录密码格式不正确',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];

    /**
     * 自定义图片验证规则
     *
     * @param  mixed  $value 验证数据
     * @return bool
     */
    public function catpcha(mixed $value): bool
    {
        $captchaService = new CaptchaService();

        return $captchaService->valid($value);
    }
}
