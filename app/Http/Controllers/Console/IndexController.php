<?php

declare(strict_types=1);

namespace App\Http\Controllers\Console;

use Flame\Http\Response;

class IndexController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }
}
