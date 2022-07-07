<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Cola\Http\Request;
use Cola\Http\Response;

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
        return view('login');
    }
}
