<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;

class HelpController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('index');
    }
}