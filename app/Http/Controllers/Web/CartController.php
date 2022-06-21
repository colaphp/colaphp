<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;

class CartController extends BaseController
{
    public function index(): Renderable
    {
        return view('index');
    }
}
