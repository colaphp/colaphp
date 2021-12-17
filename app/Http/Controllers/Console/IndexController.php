<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class IndexController
 * @package App\Http\Controllers\Console
 */
class IndexController extends Controller
{
    public function index(Request $request): Response
    {
        $session = $request->session();
        $session->set('name', 'daophp');

        return view('index/index');
    }
}
