<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use Flame\Http\Response;

class CategoryController extends BaseController
{
    public function __construct(
        private readonly UserService $userService = new UserService(),
    ) {
    }

    public function index(): Response
    {
        $list = $this->userService->getList();

        return view('category');
    }
}
