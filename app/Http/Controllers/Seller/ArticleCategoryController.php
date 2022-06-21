<?php

namespace App\Http\Controllers\Seller;

use app\support\Request;
use Illuminate\Http\JsonResponse;

class ArticleCategoryController extends BaseController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->success('Article Category Controller');
    }
}
