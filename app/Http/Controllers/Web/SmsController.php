<?php

namespace App\Http\Controllers;

use App\Enums\CaptchaType;
use Overtrue\EasySms\EasySms;

class SmsController extends BaseController
{
    /**
     * 发送短信验证码
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        try {
            $data = Validator::input($request->post(), [
                'mobile' => Validator::regex(MOBILE_REGEX)->setName('手机号码'),
                'captcha' => Validator::length(4, 6)->setName('验证码')
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->getMessage());
        }

        if ($request->session()->get(CaptchaType::IMG) !== $data['captcha']) {
            return $this->error('图片验证码不正确');
        }

        $seed = mt_rand(100000, 999999);
        $request->session()->set(CaptchaType::SMS . $data['mobile'], $seed);

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
