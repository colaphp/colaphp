<?php

declare(strict_types=1);

namespace App\Http\Controllers\Console;

use Cola\Http\Response;

/**
 * Class IndexController
 * @package App\Http\Controllers\Console
 */
class IndexController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }
}
