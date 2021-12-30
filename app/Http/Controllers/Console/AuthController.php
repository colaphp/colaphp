<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers\Console
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        if ($request->has('ok')) {
            // save auth
            $request->session()->set('auth', [
                'user_id' => 1
            ]);

            return $this->succeed('console');
        }

        return view('auth/login');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function forgot(Request $request): Response
    {
        if ($request->has('ok')) {
            return $this->succeed('forgot');
        }

        return view('auth/forgot');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reset(Request $request): Response
    {
        if ($request->isAjax()) {
            return $this->succeed('reset');
        }

        return view('auth/reset');
    }
}
