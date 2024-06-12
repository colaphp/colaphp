<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Flame\Http\Response;

class CategoryController extends BaseController
{
    public function index(): Response
    {
        return view('category');
    }
}
