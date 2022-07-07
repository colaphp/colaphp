<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services\User
 */
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
