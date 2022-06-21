<?php

namespace App\Http\Controllers\User;

use App\Enums\AuthType;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Spatie\RouteDiscovery\Attributes\Route;

class IndexController extends BaseController
{
    /**
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('user.index');
    }

    /**
     * @return JsonResponse
     */
    #[Route(method: 'POST', fullUri: 'user/logout', name: 'user.logout')]
    public function logout(): JsonResponse
    {
        session([AuthType::USER => null]);
        return $this->success('注销成功');
    }
}
