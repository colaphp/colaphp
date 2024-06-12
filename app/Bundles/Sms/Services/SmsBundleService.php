<?php

declare(strict_types=1);

namespace App\Bundles\Sms\Services;

use App\Bundles\Sms\Constants\SmsConst;
use Exception;
use Flame\Foundation\Exception\CustomException;
use Flame\Sms\SmsManager;
use Flame\Support\Facade\RateLimiter;

class SmsBundleService
{
    /**
     * 发送短信验证码
     *
     * @throws Exception
     */
    public function sendCode(string $mobile): bool
    {
        $limiter = $this->getCacheKey($mobile.'limiter');
        if (RateLimiter::tooManyAttempts($limiter, 1)) { // 1分钟内最多发送1次
            $seconds = RateLimiter::availableIn($limiter);

            throw new CustomException('短信发送请求太频繁，请在 '.$seconds.' 秒稍后再试。');
        }

        $code = mt_rand(100000, 999999);

        $sms = new SmsManager();
        if ($sms->send($mobile, 'SMS_CODE', ['code' => $code])) {
            RateLimiter::hit($limiter);

            $cacheTag = $this->getCacheKey($mobile);

            cache($cacheTag, $code, SmsConst::SMS_CACHE_EXPIRE);

            return true;
        }

        return false;
    }

    /**
     * 验证短信验证码
     */
    public function check(string $mobile, string $code): bool
    {
        $cacheTag = $this->getCacheKey($mobile);

        if (cache($cacheTag) === $code) {
            // 验证通过之后，删除缓存
            cache($cacheTag, null);

            return true;
        }

        return false;
    }

    /**
     * 获取缓存key
     */
    private function getCacheKey($mobile): string
    {
        return SmsConst::SMS_CACHE_PREFIX.$mobile;
    }
}
