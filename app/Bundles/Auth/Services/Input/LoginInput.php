<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services\Input;

class LoginInput
{
    private string $username;

    private string $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
