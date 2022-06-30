<?php

namespace App\Http\Controllers\Console;

use Cola\Http\Response;

class IndexController extends BaseController
{
    public function index(): Response
    {
        return view('console.index');
    }
}
