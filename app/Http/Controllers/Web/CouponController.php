<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class CouponController extends BaseController
{
    public function index(): Renderable
    {
        return view('index');
    }
}
