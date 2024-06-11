<?php

declare(strict_types=1);

namespace App\Bundles\OAuth\Services;

use Exception;
use Overtrue\Socialite\Contracts\UserInterface;
use Overtrue\Socialite\SocialiteManager;

class SocializeService
{
    private array $supportOAuthType = [
        'qq', 'wechat', 'weibo',
    ];

    /**
     * 社会化授权登录
     *
     * @param  string  $type  授权类型
     *
     * @throws Exception
     */
    public function redirect(string $type): string
    {
        if (! in_array($type, $this->supportOAuthType)) {
            throw new Exception('Unsupported OAuth type '.$type);
        }

        $config = config('services.'.$type);
        $socialite = new SocialiteManager($config);

        return $socialite->create($type)->redirect();
    }

    /**
     * 社会化授权登录回调
     *
     * @param  string  $type  授权类型
     * @param  string  $code  授权code
     *
     * @throws Exception
     */
    public function callback(string $type, string $code): UserInterface
    {
        if (! in_array($type, $this->supportOAuthType)) {
            throw new Exception('Unsupported OAuth type '.$type);
        }

        $config = config('services.'.$type);
        $socialite = new SocialiteManager($config);

        return $socialite->create($type)->userFromCode($code);
    }
}
