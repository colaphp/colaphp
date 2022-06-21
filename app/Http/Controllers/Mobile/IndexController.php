<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\JsonResponse;

class IndexController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('API interface');
    }
}
