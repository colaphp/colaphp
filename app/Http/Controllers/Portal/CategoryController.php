<?php

declare(strict_types=1);

namespace App\Http\Controllers\Portal;

use Flame\Http\Response;

class CategoryController extends BaseController
{
    public function index(): Response
    {
        return view('category');
    }
}
