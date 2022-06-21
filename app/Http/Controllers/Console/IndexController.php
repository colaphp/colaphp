<?php

namespace App\Http\Controllers\Console;

use App\Enums\AuthType;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Renderable;

class IndexController extends BaseController
{
    public function index(): Renderable
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
