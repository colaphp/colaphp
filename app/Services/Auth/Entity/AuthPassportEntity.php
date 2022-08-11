<?php

declare(strict_types=1);

namespace App\Services\Auth\Entity;

/**
 * Class AuthPassportEntity
 */
class AuthPassportEntity
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $passport;

    /**
     * @var string
     */
    private string $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPassport(): string
    {
        return $this->passport;
    }

    /**
     * @param  string  $passport
     */
    public function setPassport(string $passport): void
    {
        $this->passport = $passport;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param  string  $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
