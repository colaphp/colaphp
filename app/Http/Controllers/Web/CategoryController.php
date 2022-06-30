<?php

namespace App\Http\Controllers\Web;

use Swift\Http\Response;

class CategoryController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('index');
    }
}
