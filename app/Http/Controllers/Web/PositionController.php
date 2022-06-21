<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class PositionController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}
