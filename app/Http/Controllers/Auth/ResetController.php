<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Cola\Http\Request;
use Cola\Http\Response;

class ResetController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('reset');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function reset(Request $request): Response
    {
        return $this->success('ok');
    }
}
