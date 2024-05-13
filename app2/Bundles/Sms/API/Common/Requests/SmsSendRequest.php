<?php

declare(strict_types=1);

namespace App\Bundles\Sms\API\Common\Requests;

use Flame\Validation\Validator;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SmsSendRequest',
    required: ['mobile', 'captcha', 'uuid'],
    properties: [
        new OA\Property(property: 'mobile', description: '手机号码', type: 'string', example: '13901889999'),
        new OA\Property(property: 'captcha', description: '图片验证码', type: 'string', example: '000000'),
        new OA\Property(property: 'uuid', description: '图片验证码UUID', type: 'string', example: '123456'),
    ]
)]
class SmsSendRequest extends Validator
{
    protected array $rule = [
        'mobile' => 'require|mobile',
        'captcha' => 'require|captcha',
        'uuid' => 'require',
    ];

    protected array $message = [
        'mobile.require' => '请输入手机号码',
        'mobile.mobile' => '手机号码格式不符合',
        'captcha.require' => '请输入图片验证码',
        'captcha.captcha' => '图片验证码不正确',
        'uuid.require' => '请输入uuid参数',
    ];
}
