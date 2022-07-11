<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Cola\Http\Request;
use Cola\Http\Response;

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
    public function index(Request $request): Response
    {
        return view('forgot');
    }
}
