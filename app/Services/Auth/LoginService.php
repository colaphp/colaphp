<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;

/**
 * Class LoginService
 * @package App\Services\Auth
 */
class LoginService
{
    /**
     * @var User
     */
    private User $user;

    /**
     * LoginService constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
