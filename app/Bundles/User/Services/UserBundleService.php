<?php

declare(strict_types=1);

namespace App\Bundles\User\Services;

use App\Entities\UserEntity;
use App\Services\UserService;

readonly class UserBundleService
{
    public function __construct(
        private UserService $userService = new UserService(),
    ) {
    }

    public function getUser(int $id): UserEntity
    {
        $user = $this->userService->getOneById($id);

        $userEntity = new UserEntity();
        $userEntity->setData($user);

        return $userEntity;
    }
}
