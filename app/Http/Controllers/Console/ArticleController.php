<?php

namespace App\Http\Controllers\Console;

use App\Support\Request;
use App\Support\Response;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Console
 */
class ArticleController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return json('Article');
    }
}
