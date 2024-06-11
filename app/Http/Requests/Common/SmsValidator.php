<?php

declare(strict_types=1);

namespace App\Http\Requests\Common;

use App\Service\Captcha\CaptchaService;
use Flame\Validation\Validator;

/**
 * Class SmsValidator
 */
class SmsValidator extends Validator
{
    /**
     * @var array
     */
    protected $rule = [
        'mobile' => 'require|mobile',
        'captcha' => 'require|captcha',
    ];

    /**
     * @var array
     */
    protected $message = [
        'mobile.require' => '手机号码必须',
        'mobile.mobile' => '手机号码格式不正确',
        'captcha.require' => '图片验证码必须',
        'captcha.captcha' => '图片验证码不正确',
    ];

    /**
     * 自定义图片验证规则
     *
     * @param  mixed  $value  验证数据
     */
    public function catpcha(mixed $value): bool
    {
        $captchaService = new CaptchaService();

        return $captchaService->valid($value);
    }
}
