<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Forgot\EmailValidator;
use App\Http\Requests\Auth\Forgot\MobileValidator;
use Cola\Http\Request;
use Cola\Http\Response;

class ForgotController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('forgot');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function email(Request $request): Response
    {
        $v = new EmailValidator();
        if (!$v->check($request->post())) {
            return $this->error($v->getError());
        }

        $email = $request->post('email');

        return $this->success($email);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function mobile(Request $request): Response
    {
        $v = new MobileValidator();
        if (!$v->check($request->post())) {
            return $this->error($v->getError());
        }

        $mobile = $request->post('mobile');

        return $this->success($mobile);
    }
}
