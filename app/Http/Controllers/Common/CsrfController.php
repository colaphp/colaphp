<?php

declare(strict_types=1);

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Cola\Http\Request;
use Cola\Http\Response;

class CsrfController extends Controller
{
    /**
     * CSRF TOKEN
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->success($request->sessionId());
    }
}
