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

    /**
     * @var int
     */
    private int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
