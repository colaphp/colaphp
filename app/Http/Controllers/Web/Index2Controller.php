<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class IndexController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}
