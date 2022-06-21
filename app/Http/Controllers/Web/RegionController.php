<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class RegionController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success('ok');
    }
}
