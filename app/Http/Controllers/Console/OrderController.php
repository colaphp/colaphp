<?php

namespace App\Http\Controllers\Console;

use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('');
    }
}
