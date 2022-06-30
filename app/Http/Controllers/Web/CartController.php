<?php

namespace App\Http\Controllers\Web;

use Swift\Http\Response;

class CartController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }
}
