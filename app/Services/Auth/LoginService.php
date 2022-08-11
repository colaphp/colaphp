<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Services\Auth\Object\Input\LoginInput;
use App\Services\Auth\Object\Input\MobileLoginInput;
use Cola\Database\DB;
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
     * @param  LoginInput  $loginInput
     * @return int
     *
     * @throws Exception
     */
    public function login(LoginInput $loginInput): int
    {
        $passport = $loginInput->getUsername();
        $condition = $this->username($passport);

        $user = DB::table('ums_user')->where($condition, $passport)->where('status', 1)->first();
        if (is_null($user)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($loginInput->getPassword(), $user->password)) {
            return $user->id;
        }

        throw new Exception('登录用户密码不正确');
    }

    /**
     * 手机号码登录服务
     *
     * @param  MobileLoginInput  $mobileLoginInput
     * @return int
     *
     * @throws Exception
     */
    public function loginByMobile(MobileLoginInput $mobileLoginInput): int
    {
        $mobile = $mobileLoginInput->getMobile();

        $user = DB::table('ums_user')->where('mobile', $mobile)->where('status', 1)->first();
        if (is_null($user)) {
            throw new Exception('登录用户不存在');
        }

        if (password_verify($mobileLoginInput->getSmsCode(), $user->remember_token)) {
            return $user->id;
        }

        throw new Exception('手机验证码不正确');
    }

    /**
     * 根据用户获取登录类型
     *
     * @param  string  $username
     * @return string
     */
    private function username(string $username): string
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
