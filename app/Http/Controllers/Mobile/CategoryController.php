<?php

namespace App\Http\Controllers\Mobile;

class CategoryController extends BaseController
{
    /**
     * @return
     */
    public function index()
    {
        return $this->success('category');
    }
}
