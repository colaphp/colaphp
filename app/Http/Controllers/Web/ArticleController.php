<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class ArticleController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('article.index');
    }
}
