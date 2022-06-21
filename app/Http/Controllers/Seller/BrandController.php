<?php

namespace App\Http\Controllers\Seller;

use app\support\Request;
use Illuminate\Http\JsonResponse;

class BrandController extends BaseController
{
    public function index(Request $request): JsonResponse
    {
        return $this->success('brand/index');
    }
}
