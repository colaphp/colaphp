<?php

declare(strict_types=1);

namespace App\Service\Captcha;

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

class CaptchaService
{
    const SESSION_KEY = 'CAPTCHA';

    /**
     * 生成图片验证码
     *
     * @param  int  $length
     * @param  string  $suffix
     * @return bool|string
     */
    public function create(int $length = 4, string $suffix = ''): bool|string
    {
        $phraseBuilder = new PhraseBuilder($length, '023456789');
        // 初始化验证码
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        // 生成验证码
        $builder->build(120);
        // 将验证码的值存储
        session([CaptchaService::SESSION_KEY.$suffix => $builder->getPhrase()]);
        // 获得验证码图片二进制数据
        return $builder->get();
    }

    /**
     * 验证图片验证码
     *
     * @param  string  $captcha
     * @param  string  $suffix
     * @return bool
     */
    public function valid(string $captcha = '', string $suffix = ''): bool
    {
        return session(CaptchaService::SESSION_KEY.$suffix) === $captcha;
    }
}
