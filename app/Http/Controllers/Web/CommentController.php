<?php

namespace App\Http\Controllers\Web;

use Swift\Http\Response;

class CommentController extends BaseController
{
    public function index(): Response
    {
        return view('index');
    }
}
