<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class ResetController
 * @package App\Http\Controllers\Auth
 */
class ResetController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->success('auth/reset');
    }
}
