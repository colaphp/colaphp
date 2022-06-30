<?php

namespace App\Http\Controllers\Web;

use Swift\Http\Response;

class ArticleController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('article.index');
    }
}
