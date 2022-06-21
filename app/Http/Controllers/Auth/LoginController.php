<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\Internal\Input\LoginInput;
use App\Services\Auth\Internal\Input\MobileLoginInput;
use App\Services\Auth\PassportService;
use Exception;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Swift\Http\Request;
use Swift\Http\Response;
use Swift\Log\Log;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * 用户名、邮箱、手机号码与密码登录
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($request->isAjax()) {
            try {
                $data = Validator::input($request->post(), [
                    'passport' => Validator::notBlank()->setName('账号'),
                    'password' => Validator::length(6, 64)->setName('密码'),
                    'captcha' => Validator::length(4, 6)->setName('验证码')
                ]);
            } catch (ValidationException $e) {
                return $this->error($e->getMessage());
            }

            if ($request->session()->get(USER_CAPTCHA) !== $data['captcha']) {
                return $this->error('图片验证码不正确');
            }

            $loginInput = new LoginInput();
            $loginInput->setUsername($request->post('username'));
            $loginInput->setPassword($request->post('password'));

            try {
                $passportService = new PassportService();
                $userId = $passportService->login($loginInput);
                $token = $passportService->createToken($userId);
                return $this->success($token)->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return $this->error('用户名或密码不正确');
            }
        }

        return view('auth.login');
    }

    /**
     * 手机号码与短信验证码登录
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

        $mobileLoginInput = new MobileLoginInput();
        $mobileLoginInput->setMobile($request->post('mobile'));
        $mobileLoginInput->setSmsCode($request->post('sms_code'));

        try {
            $passportService = new PassportService();
            $userId = $passportService->loginByMobile($mobileLoginInput);
            $token = $passportService->createToken($userId);
            return $this->success($token)->cookie(USER_TOKEN, $token, 0, '/', '', false, true);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error('手机验证码不正确');
        }
    }

    /**
     * 社会化授权登录
     * @param Request $request
     * @return void
     */
    public function socialize(Request $request)
    {
        // todo
    }
}
