<?php

namespace App\Http\Controllers\User;

use Swift\Http\Response;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('user');
    }
}
