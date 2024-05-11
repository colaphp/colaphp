<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Forgot;

use App\Service\Captcha\CaptchaService;
use Flame\Validation\Validator;

/**
 * Class EmailValidator
 */
class EmailValidator extends Validator
{
    /**
     * @var array
     */
    protected $rule = [
        'email' => 'require|email',
        'captcha' => 'require|captcha',
    ];

    /**
     * @var array
     */
    protected $message = [
        'email.email' => '电子邮箱地址必须',
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
