<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class CatalogController extends BaseController
{
    public function index(): Renderable
    {
        return view('index');
    }
}
