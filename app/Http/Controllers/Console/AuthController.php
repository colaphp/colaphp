<?php

namespace App\Http\Controllers\Console;

use App\Enums\AuthType;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Renderable;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return Redirect|Renderable
     */
    public function login(Request $request): Redirect|Renderable
    {
		if ($request->isPost()) {
            session(AuthType::ADMIN, true);
            $callback = $request->get('callback', '/console');
            return redirect($callback);
        }

        return view('login');
    }

    /**
     * @param Request $request
     * @return JsonResponse|Renderable
     */
    public function forgot(Request $request): Renderable|Json
    {
        if ($request->isPost()) {
            return $this->success('forgot');
        }

        return view('forgot');
    }

    /**
     * @param Request $request
     * @return JsonResponse|Renderable
     */
    public function reset(Request $request): Renderable|Json
    {
        if ($request->isPost()) {
            return $this->success('reset');
        }

        return view('reset');
    }
}