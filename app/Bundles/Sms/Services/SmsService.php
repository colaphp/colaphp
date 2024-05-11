<?php

declare(strict_types=1);

namespace App\Service\Sms;

use Flame\Log\Log;
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
     *
     * @param  string  $mobile
     * @param  string  $seed
     * @return bool
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
     *
     * @param  string  $mobile
     * @param  string  $code
     * @return bool
     */
    public function valid(string $mobile, string $code): bool
    {
        return session(SmsService::SESSION_KEY.$mobile) === $code;
    }
}
