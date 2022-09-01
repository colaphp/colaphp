<?php

declare(strict_types=1);

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\SmsValidator;
use App\Service\Sms\SmsService;
use Cola\Http\Request;
use Cola\Http\Response;

class SmsController extends Controller
{
    /**
     * 发送短信验证码
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $v = new SmsValidator();
        if (! $v->check($request->post())) {
            return $this->error($v->getError());
        }

        $seed = (string) mt_rand(100000, 999999);
        $smsService = new SmsService();
        if ($smsService->send($request->post('mobile'), $seed)) {
            return $this->success('短信验证码发送成功');
        } else {
            return $this->error('短信验证码发送失败');
        }
    }
}
