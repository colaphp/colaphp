<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Swift\Http\Response;

/**
 * Class IndexController
 * @package App\Http\Controllers\Api
 */
class IndexController extends Controller
{
    public function index(): Response
    {
        return $this->succeed(['api server']);
    }
}
