<?php

namespace App\Services\Auth\Internal\Input;

use App\Support\SimpleAccess;

/**
 * Class LoginInput
 * @package App\Services\Auth\Internal\Input
 */
class LoginInput
{
    use SimpleAccess;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}
