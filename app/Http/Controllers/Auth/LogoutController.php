<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Flame\Http\Request;
use Flame\Http\Response;

class LogoutController extends Controller
{
    public function index(Request $request): Response
    {
        if ($request->isAjax()) {
            session(['uid' => 0]);

            return $this->success('注销成功');
        }

        return redirect('/');
    }
}
