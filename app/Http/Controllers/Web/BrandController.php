<?php

namespace App\Http\Controllers\Web;

use Swift\Http\Response;

class BrandController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }
}
