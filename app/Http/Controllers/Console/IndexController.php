<?php

namespace App\Http\Controllers\Console;

use App\Enums\AuthType;
use Illuminate\Http\JsonResponse;
use Swift\Http\Response;

class IndexController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        session([AuthType::ADMIN => null]);
        return $this->success('logout');
    }
}
