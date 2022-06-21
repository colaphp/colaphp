<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class GoodsController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}
