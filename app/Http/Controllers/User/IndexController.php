<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Flame\Http\Request;
use Flame\Http\Response;

class IndexController extends BaseController
{
    public function index(Request $request): Response
    {
        return $this->success(['msg' => 'ok', 'request' => $request->all(), 'path' => $request->path()]);
    }
}
