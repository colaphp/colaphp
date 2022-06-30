<?php

namespace App\Http\Controllers\Shop;

use Swift\Http\Response;

class IndexController extends BaseController
{
    public function index(): Response
    {
        return response('test');
    }
}
