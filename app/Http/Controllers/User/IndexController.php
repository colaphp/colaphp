<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class IndexController
 * @package App\Http\Controllers\User
 */
class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('index/index');
    }
}
