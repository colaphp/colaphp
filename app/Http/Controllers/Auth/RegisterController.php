<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Internal\Input\RegisterInput;
use App\Services\Auth\PassportService;
use Exception;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Swift\Http\Request;
use Swift\Http\Response;
use Swift\Log\Log;
use Swift\Support\Carbon;
use Swift\Support\Str;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * 用户注册服务
     * @param Request $request
     * @return Response
     */
    public function username(Request $request): Response
    {
        try {
            $data = Validator::input($request->post(), [
                'username' => Validator::alnum()->length(5, 64)->setName('用户名'),
                'password' => Validator::length(6, 64)->setName('密码'),
                'captcha' => Validator::length(4, 6)->setName('验证码')
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }

        if ($request->session()->get(USER_CAPTCHA) !== $data['captcha']) {
            return $this->error('图片验证码不正确');
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername($data['username']);
        $registerInput->setPassword($data['password']);
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'username');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error('用户注册失败');
        }
    }

    /**
     * 邮箱注册服务
     * @param Request $request
     * @return Response
     */
    public function email(Request $request): Response
    {
        try {
            $data = Validator::input($request->post(), [
                'email' => Validator::email()->setName('邮箱'),
                'password' => Validator::length(6, 64)->setName('密码'),
                'captcha' => Validator::length(4, 6)->setName('短信验证码')
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }

        if ($request->session()->get(USER_CAPTCHA) !== $data['captcha']) {
            return $this->error('图片验证码不正确');
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random(6) . Str::startsWith($data['email'], '@'));
        $registerInput->setPassword($data['password']);
        $registerInput->setEmail($data['email']);
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'email');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error('用户注册失败');
        }
    }

    /**
     * 手机号码注册服务
     * @param Request $request
     * @return Response
     */
    public function mobile(Request $request): Response
    {
        try {
            $data = Validator::input($request->post(), [
                'mobile' => Validator::regex(MOBILE_REGEX)->setName('手机号码'),
                'sms_code' => Validator::length(4, 6)->setName('短信验证码')
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }

        if ($request->session()->get(USER_SMS_CODE . $data['mobile']) !== $data['sms_code']) {
            return $this->error('短信验证码不正确');
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random(6) . Str::substr($data['mobile'], -4));
        $registerInput->setPassword(password_hash($data['captcha'], PASSWORD_DEFAULT));
        $registerInput->setMobile($data['mobile']);
        $registerInput->setCreatedTime(Carbon::now());

        try {
            return $this->registerResponse($registerInput, 'mobile');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error('手机号注册失败');
        }
    }

    /**
     * 注册处理及响应
     * @param RegisterInput $registerInput
     * @param string $registerType
     * @return Response
     * @throws Exception
     */
    private function registerResponse(RegisterInput $registerInput, string $registerType): Response
    {
        $passportService = new PassportService();
        $userId = $passportService->register($registerInput, $registerType);
        $token = $passportService->createToken($userId);
        return $this->success($token)->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
    }
}
