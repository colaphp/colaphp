<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\InvalidArgumentException;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;
use Swift\Http\Request;
use Swift\Http\Response;
use Swift\Log\Log;

/**
 * Class MiscController
 * @package App\Http\Controllers\Common
 */
class MiscController extends Controller
{
    /**
     * CSRF TOKEN
     * @param Request $request
     * @return Response
     */
    public function csrf(Request $request): Response
    {
        return $this->success($request->sessionId());
    }

    /**
     * 生成验证码
     * @param Request $request
     * @return Response
     */
    public function captcha(Request $request): Response
    {
        $phraseBuilder = new PhraseBuilder(4, '023456789');
        // 初始化验证码
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        // 生成验证码
        $builder->build(120);
        // 将验证码的值存储
        $request->session()->set(USER_CAPTCHA, $builder->getPhrase());
        // 获得验证码图片二进制数据
        $captcha = $builder->get();
        // 输出验证码二进制数据
        return response($captcha, 200, ['Content-Type' => 'image/jpeg']);
    }

    /**
     * 发送短信验证码
     * @param Request $request
     * @return Response
     */
    public function sms(Request $request): Response
    {
        try {
            $data = Validator::input($request->post(), [
                'mobile' => Validator::regex(MOBILE_REGEX)->setName('手机号码'),
                'captcha' => Validator::length(4, 6)->setName('验证码')
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }

        if ($data['captcha'] !== $request->session()->get(USER_CAPTCHA)) {
            return $this->error('图片验证码不正确');
        }

        $seed = mt_rand(100000, 999999);
        $request->session()->set(USER_SMS_CODE . $data['mobile'], $seed);

        try {
            $config = config('sms');
            $easySms = new EasySms($config);
            $easySms->send($data['mobile'], [
                'content' => '您的验证码为: ' . $seed,
                'template' => 'SMS_001',
                'data' => [
                    'code' => $seed
                ],
            ]);
            return $this->success('短信验证码发送成功');
        } catch (InvalidArgumentException|NoGatewayAvailableException $e) {
            Log::error($e->getMessage());
            return $this->error('短信验证码发送失败');
        }
    }
}
