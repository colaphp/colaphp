<?php

declare(strict_types=1);

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Services\Captcha\CaptchaService;
use Cola\Http\Response;

class CaptchaController extends Controller
{
    /**
     * 生成验证码
     *
     * @return Response
     */
    public function index(): Response
    {
        $captchaService = new CaptchaService();

        return response($captchaService->create(), 200, ['Content-Type' => 'image/jpeg']);
    }
}
