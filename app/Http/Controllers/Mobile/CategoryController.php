<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('category');
    }
}
