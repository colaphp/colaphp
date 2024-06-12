<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\Register\EmailValidator;
use App\Http\Requests\Auth\Register\MobileValidator;
use App\Http\Requests\Auth\Register\UsernameValidator;
use App\Service\Auth\AuthService;
use App\Service\Auth\Input\RegisterInput;
use App\Service\Auth\RegisterService;
use Exception;
use Flame\Http\Request;
use Flame\Http\Response;
use Flame\Log\Log;
use Flame\Support\Carbon;
use Flame\Support\Str;

class RegisterController extends BaseController
{
    public function index(): Response
    {
        return view('register');
    }

    /**
     * 用户注册服务
     */
    public function username(Request $request): Response
    {
        $v = new UsernameValidator();
        if (! $v->check($request->post())) {
            return $this->fail($v->getError());
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername($request->post('username'));
        $registerInput->setPassword($request->post('password'));
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'username');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->fail('用户注册失败');
        }
    }

    /**
     * 邮箱注册服务
     */
    public function email(Request $request): Response
    {
        $v = new EmailValidator();
        if (! $v->check($request->post())) {
            return $this->fail($v->getError());
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random(6).'_'.Str::startsWith($request->post('email'), '@'));
        $registerInput->setPassword($request->post('password'));
        $registerInput->setEmail($request->post('email'));
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'email');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->fail('用户注册失败');
        }
    }

    /**
     * 手机号码注册服务
     */
    public function mobile(Request $request): Response
    {
        $v = new MobileValidator();
        if (! $v->check($request->post())) {
            return $this->fail($v->getError());
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random(6).'_'.Str::substr($request->post('mobile'), -4));
        $registerInput->setPassword($request->post('captcha'));
        $registerInput->setMobile($request->post('mobile'));
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'mobile');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return $this->fail('手机号注册失败');
        }
    }

    /**
     * 注册处理及响应
     *
     *
     * @throws Exception
     */
    private function registerResponse(RegisterInput $registerInput, string $registerType): Response
    {
        $passportService = new RegisterService();
        $userId = $passportService->register($registerInput, $registerType);
        $authService = new AuthService();
        $token = $authService->createToken($userId);

        return $this->success($token); // ->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
    }
}
