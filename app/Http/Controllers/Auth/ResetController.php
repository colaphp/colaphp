<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flame\Http\Request;
use Flame\Http\Response;

class ResetController extends Controller
{
    public function index(Request $request): Response
    {
        return view('reset');
    }

    public function reset(Request $request): Response
    {
        return $this->success('ok');
    }
}
