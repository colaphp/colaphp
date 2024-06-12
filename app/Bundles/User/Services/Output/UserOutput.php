<?php

declare(strict_types=1);

namespace App\Bundles\User\Services\Output;

class UserOutput
{
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
