<?php

namespace App\Http\Controllers\Supplier;

use Illuminate\Http\JsonResponse;

class IndexController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('please visit later.');
    }
}
