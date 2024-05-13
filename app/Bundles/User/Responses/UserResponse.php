<?php

declare(strict_types=1);

namespace App\Bundles\User\Responses;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserResponse')]
class UserResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: '编号', type: 'integer', example: 1)]
    private int $id;

    #[OA\Property(property: 'name', description: '名称', type: 'string', example: 'untitle')]
    private int $name;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(int $name): void
    {
        $this->name = $name;
    }
}
