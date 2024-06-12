<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Controllers\Common;

use App\Bundles\Auth\Controllers\Common\Requests\Forgot\EmailValidator;
use App\Bundles\Auth\Controllers\Common\Requests\Forgot\MobileValidator;
use App\Http\Controllers\BaseController;
use Flame\Http\Request;
use Flame\Http\Response;
use Flame\Validation\Exception\ValidationException;

class ForgotController extends BaseController
{
    public function index(Request $request): Response
    {
        return view('forgot');
    }

    public function email(Request $request): Response
    {
        $v = new EmailValidator();
        if (! $v->check($request->post())) {
            throw new ValidationException($v->getError());
        }

        $email = $request->post('email');

        return $this->success($email);
    }

    public function mobile(Request $request): Response
    {
        $v = new MobileValidator();
        if (! $v->check($request->post())) {
            throw new ValidationException($v->getError());
        }

        $mobile = $request->post('mobile');

        return $this->success($mobile);
    }
}
