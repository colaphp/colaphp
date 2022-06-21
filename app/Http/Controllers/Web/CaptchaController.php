<?php

namespace App\Http\Controllers;

use think\captcha\facade\Captcha;
use think\Response;

class CaptchaController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Captcha::create();
    }
}
