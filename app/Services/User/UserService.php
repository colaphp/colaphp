<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    /**
     * @var \App\Models\User
     */
    private User $user;

    /**
     * UserService constructor.
     * @param \App\Models\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
