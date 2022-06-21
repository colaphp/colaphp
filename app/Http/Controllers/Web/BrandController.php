<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class BrandController extends BaseController
{
    public function index(): Renderable
    {
        return view('index');
    }
}
