<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class CommentController extends BaseController
{
    public function index(): Renderable
    {
        return view('index');
    }
}
