<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use Flame\Http\Response;
use Flame\Support\Facade\Cache;

class CategoryController extends BaseController
{
    public function __construct(
        private readonly UserService $userService = new UserService(),
    )
    {
    }

    public function index(): Response
    {
        return view('category');
    }

    public function json(): Response
    {
        $list2 = Cache::rememberForever('list2', function () {
            return $this->userService->getList();
        });

        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = $list2;
        }

        return json($data);
    }
}
