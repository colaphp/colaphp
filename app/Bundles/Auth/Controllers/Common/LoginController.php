<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Common;

use App\Bundles\Auth\Controllers\Common\Requests\Login\MobileValidator;
use App\Bundles\Auth\Controllers\Common\Requests\Login\UsernameValidator;
use App\Http\Controllers\Auth\AuthService;
use App\Http\Controllers\Auth\LoginService;
use App\Http\Controllers\BaseController;
use App\Service\Auth\Input\LoginByMobileInput;
use App\Service\Auth\Input\LoginInput;
use Exception;
use Flame\Http\Request;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use Flame\Validation\Exception\ValidationException;

class LoginController extends BaseController
{
    public function index(): Response
    {
        return view('login');
    }

    /**
     * 用户名、邮箱、手机号码与密码登录
     */
    public function passport(Request $request): Response
    {
        $v = new UsernameValidator();
        if (! $v->check($request->post())) {
            throw new ValidationException($v->getError());
        }

        $loginInput = new LoginInput();
        $loginInput->setUsername($request->post('username'));
        $loginInput->setPassword($request->post('password'));

        try {
            $loginService = new LoginService();
            $userId = $loginService->login($loginInput);
            $authService = new AuthService();
            $token = $authService->createToken($userId);

            return $this->success($token); // ->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->fail('用户名或密码不正确');
        }
    }

    /**
     * 手机号码与短信验证码登录
     */
    public function sms(Request $request): Response
    {
        $v = new MobileValidator();
        if (! $v->check($request->post())) {
            throw new ValidationException($v->getError());
        }

        $mobileLoginInput = new LoginByMobileInput();
        $mobileLoginInput->setMobile($request->post('mobile'));
        $mobileLoginInput->setSmsCode($request->post('sms_code'));

        try {
            $loginService = new LoginService();
            $userId = $loginService->loginByMobile($mobileLoginInput);
            $authService = new AuthService();
            $token = $authService->createToken($userId);

            return $this->success($token); // ->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->fail('手机验证码不正确');
        }
    }
}
