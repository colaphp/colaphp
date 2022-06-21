<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\JsonResponse;

class AccountController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('');
    }
}