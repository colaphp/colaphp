<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class SitemapController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}
