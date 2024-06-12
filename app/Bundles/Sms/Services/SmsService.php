<?php

declare(strict_types=1);

namespace App\Bundles\Sms\Services;

use Flame\Support\Facade\Log;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\InvalidArgumentException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SmsService
{
    /**
     * Session Key
     */
    const SESSION_KEY = 'SMS';

    /**
     * 发送短信验证码
     */
    public function send(string $mobile, string $seed): bool
    {
        session([SmsService::SESSION_KEY.$mobile, $seed]);

        try {
            $easySms = new EasySms(config('sms'));
            $result = $easySms->send($mobile, [
                'content' => '您的验证码为: '.$seed,
                'template' => 'SMS_001',
                'data' => [
                    'code' => $seed,
                ],
            ]);

            return true;
        } catch (InvalidArgumentException|NoGatewayAvailableException $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    /**
     * 验证短信验证码
     */
    public function valid(string $mobile, string $code): bool
    {
        return session(SmsService::SESSION_KEY.$mobile) === $code;
    }
}
