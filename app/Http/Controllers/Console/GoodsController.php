<?php

namespace App\Http\Controllers\Console;

use Illuminate\Http\JsonResponse;

class GoodsController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('');
    }
}
