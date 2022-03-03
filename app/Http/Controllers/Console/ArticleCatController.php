<?php

namespace App\Http\Controllers\Console;

use App\Support\Request;
use App\Support\Response;

/**
 * Class ArticleCatController
 * @package App\Http\Controllers\Console
 */
class ArticleCatController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function testDemo(Request $request): Response
    {
        return json('ArticleCat');
    }
}
