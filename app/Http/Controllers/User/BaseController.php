<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

abstract class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
