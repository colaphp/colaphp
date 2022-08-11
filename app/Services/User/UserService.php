<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Model\User;
use App\Services\User\Object\Output\UserOutput;

/**
 * Class UserService
 */
class UserService
{
    /**
     * @param int $userId
     * @return UserOutput|null
     */
    public function findOne(int $userId): ?UserOutput
    {
        $user = User::query()->first($userId);

        $userOutput = new UserOutput();
        if ($user) {
            $userOutput->setId($user->id);
            return $userOutput;
        }

        return null;
    }
}
