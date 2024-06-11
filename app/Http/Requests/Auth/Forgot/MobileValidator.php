<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\Forgot;

use App\Service\Sms\SmsService;
use Flame\Validation\Validator;

class MobileValidator extends Validator
{
    protected array $rule = [
        'mobile' => 'require|mobile',
        'sms_code' => 'require|code',
    ];

    protected array $message = [
        'mobile.require' => '手机号码必须',
        'mobile.mobile' => '手机号码格式不正确',
        'sms_code.require' => '短信验证码必须',
        'sms_code.code' => '短信验证码不正确',
    ];

    /**
     * 自定义短信验证规则
     *
     * @param  mixed  $value  验证数据
     * @param  mixed  $rule  验证规则
     * @param  array  $data  全部数据
     */
    public function code(mixed $value, mixed $rule, array $data = []): bool
    {
        $captchaService = new SmsService();

        return $captchaService->valid($data['mobile'], $value);
    }
}
