<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\JsonResponse;

class MessageController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('');
    }
}
