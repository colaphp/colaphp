<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers\User
 */
class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        return view('auth/login');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        return view('auth/login');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function forgot(Request $request): Response
    {
        return view('auth/forgot');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reset(Request $request): Response
    {
        return view('auth/reset');
    }
}
