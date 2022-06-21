<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\JsonResponse;

class IndexController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('');
    }
}
