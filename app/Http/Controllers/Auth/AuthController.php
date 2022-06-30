<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CaptchaType;
use App\Http\Controllers\Controller;
use App\Rules\MobileRule;
use App\Services\Auth\Internal\Input\LoginInput;
use App\Services\Auth\Internal\Input\MobileLoginInput;
use App\Services\Auth\Internal\Input\RegisterInput;
use App\Services\Auth\PassportService;
use Exception;
use Swift\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Spatie\RouteDiscovery\Attributes\Route;

class AuthController extends Controller
{
    /**
     * 用户密码登录
     * @param Request $request
     * @return Response
     */
    #[Route(fullUri: 'login', name: 'user.auth.login')]
    public function login(Request $request): Response
    {
        return view('user.login', $request->all());
    }

    /**
     * 用户名、邮箱、手机号码与密码登录
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'login')]
    public function loginHandle(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request->all(), [
                'passport' => 'required|max:16',
                'password' => 'required|min:6|max:64',
                'captcha' => 'required|min:4|max:6',
            ], [
                'passport.required' => '用户名必须',
                'passport.max' => '用户名最多不能超过16个字符',
                'password.required' => '登录密码必须',
                'password.min' => '登录密码格式不正确',
                'password.max' => '登录密码格式不正确',
                'captcha.required' => '图片验证码必须',
                'captcha.min' => '验证码格式不正确',
                'captcha.max' => '验证码格式不正确',
            ]);
        } catch (ValidationException|Exception $e) {
            return $this->error($e->getMessage());
        }

        try {
            if (session()->get(CaptchaType::IMG) !== $data['captcha']) {
                return $this->error('图片验证码不正确');
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $this->error($e->getMessage());
        }

        $loginInput = new LoginInput();
        $loginInput->setUsername($data['username']);
        $loginInput->setPassword($data['password']);

        try {
            $passportService = new PassportService();
            $userId = $passportService->login($loginInput);
            $token = $passportService->createToken($userId);
            return $this->success($token);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->error('用户名或密码不正确');
        }
    }

    /**
     * 手机号码与短信验证码登录
     * @param Request $request
     * @return JsonResponse|Renderable
     */
    #[Route(method: 'POST', fullUri: 'login/mobile')]
    public function mobileLogin(Request $request): JsonResponse|Renderable
    {
        try {
            $data = $this->validate($request->all(), [
                'mobile' => ['required', new MobileRule()],
                'sms_code' => 'required|size:6',
            ], [
                'mobile.required' => '手机号码必须',
                'sms_code.required' => '短信验证码必须',
                'sms_code.size' => '短信验证码格式不正确',
            ]);
        } catch (ValidationException|Exception $e) {
            return $this->error($e->getMessage());
        }

        try {
            if (session()->get(CaptchaType::SMS . $data['mobile']) !== $data['sms_code']) {
                return $this->error('短信验证码不正确');
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $this->error($e->getMessage());
        }

        $mobileLoginInput = new MobileLoginInput();
        $mobileLoginInput->setMobile($data['mobile']);
        $mobileLoginInput->setSmsCode($data['sms_code']);

        try {
            $passportService = new PassportService();
            $userId = $passportService->loginByMobile($mobileLoginInput);
            $token = $passportService->createToken($userId);
            return $this->success($token);
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
    #[Route(fullUri: 'login/socialite')]
    public function socialiteLogin(Request $request): void
    {
        // todo
    }

    /**
     * 社会化授权登录回调
     * @param Request $request
     * @return void
     */
    #[Route(fullUri: 'login/socialite/callback')]
    public function socialiteLoginCallback(Request $request): void
    {
        // todo
    }

    /**
     * 用户注册
     * @param Request $request
     * @return Response
     */
    #[Route(fullUri: 'register', name: 'user.auth.register')]
    public function register(Request $request): Response
    {
        return view('user.register', $request->all());
    }

    /**
     * 用户注册服务
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'register')]
    public function registerHandle(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request->all(), [
                'username' => 'required|max:16',
                'password' => 'required|min:6|max:64',
                'captcha' => 'required|min:4|max:6',
            ], [
                'username.required' => '用户名必须',
                'username.max' => '用户名最多不能超过16个字符',
                'password.required' => '登录密码必须',
                'password.min' => '登录密码格式不正确',
                'password.max' => '登录密码格式不正确',
                'captcha.required' => '图片验证码必须',
                'captcha.min' => '验证码格式不正确',
                'captcha.max' => '验证码格式不正确',
            ]);
        } catch (ValidationException|Exception $e) {
            return $this->error($e->getMessage());
        }

        try {
            if (session()->get(CaptchaType::IMG) !== $data['captcha']) {
                return $this->error('图片验证码不正确');
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $this->error($e->getMessage());
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
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'register/email')]
    public function emailRegister(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request->all(), [
                'email' => 'email',
                'password' => 'required|min:6|max:64',
                'captcha' => 'required|min:4|max:6',
            ], [
                'email.email' => '用户名必须',
                'password.required' => '登录密码必须',
                'password.min' => '登录密码格式不正确',
                'password.max' => '登录密码格式不正确',
                'captcha.required' => '图片验证码必须',
                'captcha.min' => '验证码格式不正确',
                'captcha.max' => '验证码格式不正确',
            ]);
        } catch (ValidationException|Exception $e) {
            return $this->error($e->getMessage());
        }

        try {
            if (session()->get(CaptchaType::IMG) !== $data['captcha']) {
                return $this->error('图片验证码不正确');
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $this->error($e->getMessage());
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random() . Str::startsWith($data['email'], '@'));
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
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'register/mobile')]
    public function mobileRegister(Request $request): JsonResponse
    {
        try {
            $data = $this->validate($request->all(), [
                'mobile' => 'mobile',
                'sms_code' => 'required|length:6',
            ], [
                'mobile.mobile' => '手机号码必须',
                'sms_code.required' => '短信验证码必须',
                'sms_code.length' => '短信验证码格式不正确',
            ]);
        } catch (ValidationException|Exception $e) {
            return $this->error($e->getMessage());
        }

        try {
            if (session()->get(CaptchaType::SMS . $data['mobile']) !== $data['sms_code']) {
                return $this->error('短信验证码不正确');
            }
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $this->error($e->getMessage());
        }

        $registerInput = new RegisterInput();
        $registerInput->setUsername(Str::random() . Str::substr($data['mobile'], -4));
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
     * 忘记密码
     * @param Request $request
     * @return Response
     */
    #[Route(fullUri: 'forget', name: 'user.auth.forget')]
    public function forget(Request $request): Response
    {
        return view('user.forget', $request->all());
    }

    /**
     * 忘记密码处理
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'forget')]
    public function forgetHandle(Request $request): JsonResponse
    {
        // TODO
        return $this->success([]);
    }

    /**
     * 重设登录
     * @param Request $request
     * @return Response
     */
    #[Route(fullUri: 'reset', name: 'user.auth.reset')]
    public function reset(Request $request): Response
    {
        return view('user.reset', $request->all());
    }

    /**
     * 重设登录处理
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'reset')]
    public function resetHandle(Request $request): JsonResponse
    {
        // TODO
        return $this->success([]);
    }

    /**
     * 注册处理及响应
     * @param RegisterInput $registerInput
     * @param string $registerType
     * @return JsonResponse
     * @throws Exception
     */
    private function registerResponse(RegisterInput $registerInput, string $registerType): JsonResponse
    {
        $passportService = new PassportService();
        $userId = $passportService->register($registerInput, $registerType);
        $token = $passportService->createToken($userId);
        return $this->success($token);
    }
}
