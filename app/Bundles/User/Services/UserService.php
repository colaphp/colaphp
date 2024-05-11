<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Models\User;
use App\Service\User\Output\UserOutput;

/**
 * Class UserService
 */
class UserService
{
    /**
     * @param  int  $userId
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
