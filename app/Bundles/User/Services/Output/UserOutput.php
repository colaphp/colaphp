<?php

declare(strict_types=1);

namespace App\Service\User\Output;

use App\Http\Traits\SimpleAccess;

/**
 * Class UserOutput
 */
class UserOutput
{
    use SimpleAccess;

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
