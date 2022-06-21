<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    /**
     * @var User
     */
    private User $user;

    /**
     * UserService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findOne(int $userId)
    {
        return null;
    }
}
