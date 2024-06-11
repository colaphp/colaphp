<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Forgot\EmailValidator;
use App\Http\Requests\Auth\Forgot\MobileValidator;
use Flame\Http\Request;
use Flame\Http\Response;

class ForgotController extends Controller
{
    public function index(Request $request): Response
    {
        return view('forgot');
    }

    public function email(Request $request): Response
    {
        $v = new EmailValidator();
        if (! $v->check($request->post())) {
            return $this->error($v->getError());
        }

        $email = $request->post('email');

        return $this->success($email);
    }

    public function mobile(Request $request): Response
    {
        $v = new MobileValidator();
        if (! $v->check($request->post())) {
            return $this->error($v->getError());
        }

        $mobile = $request->post('mobile');

        return $this->success($mobile);
    }
}
