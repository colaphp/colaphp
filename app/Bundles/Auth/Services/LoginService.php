<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use App\Models\Auth;
use App\Service\Auth\Input\LoginByMobileInput;
use App\Service\Auth\Input\LoginInput;
use Exception;

/**
 * Class LoginService
 */
class LoginService
{
    /**
     * 手机号码正则表达式
     */
    const MOBILE_PATTERN = '/^1[3-9]\d{9}$/';

    /**
     * 登录服务
     *
     *
     * @throws Exception
     */
    public function login(LoginInput $loginInput): int
    {
        $passport = $loginInput->getUsername();
        $condition = [
            'type' => $this->getAuthType($passport),
            'passport' => $passport,
        ];

        $userAuth = Auth::query()->where($condition)->first();
        if (is_null($userAuth)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($loginInput->getPassword(), $userAuth->password)) {
            return $userAuth->user_id;
        }

        throw new Exception('登录用户密码不正确');
    }

    /**
     * 手机号码登录服务
     *
     *
     * @throws Exception
     */
    public function loginByMobile(LoginByMobileInput $mobileLoginInput): int
    {
        $mobile = $mobileLoginInput->getMobile();
        $condition = [
            'type' => 'mobile',
            'passport' => $mobile,
        ];

        $userAuth = Auth::query()->where($condition)->first();
        if (is_null($userAuth)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($mobileLoginInput->getSmsCode(), $userAuth->password)) {
            return $userAuth->user_id;
        }

        throw new Exception('手机验证码不正确');
    }

    /**
     * 根据用户获取登录类型
     */
    private function getAuthType(string $username): string
    {
        if (filter_var($username, FILTER_VALIDATE_EMAIL) !== false) {
            return 'email';
        } elseif (preg_match(LoginService::MOBILE_PATTERN, $username)) {
            return 'mobile';
        } else {
            return 'username';
        }
    }
}
