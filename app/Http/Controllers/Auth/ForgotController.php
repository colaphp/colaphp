<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class ForgotController
 * @package App\Http\Controllers\Auth
 */
class ForgotController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function forgot(Request $request): Response
    {
        return $this->success('auth/forgot');
    }
}
