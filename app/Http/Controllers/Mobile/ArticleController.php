<?php

namespace App\Http\Controllers\Mobile;

class ArticleController extends BaseController
{
    /**
     * @return
     */
    public function index()
    {
        return $this->success('article');
    }
}
