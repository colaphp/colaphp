<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Cola\Http\Request;
use Cola\Http\Response;

class LogoutController extends Controller
{
    /**
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if ($request->isAjax()) {
            session(['uid' => 0]);

            return $this->success('注销成功');
        }

        return redirect('/');
    }
}
