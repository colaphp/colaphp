<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class BrandController
 * @package App\Http\Controllers\Console
 */
class BrandController extends Controller
{
    public function index(Request $request): Response
    {
        return view('brand/index');
    }
}
