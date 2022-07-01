<?php

namespace App\Http\Controllers\User;

use Cola\Http\Response;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('index');
    }
}
