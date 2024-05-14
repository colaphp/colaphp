<?php

declare(strict_types=1);

namespace App\Entities;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RoleEntity')]
class RoleEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'name', description: '角色名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'description', description: '角色描述', type: 'string')]
    private string $description;

    #[OA\Property(property: 'rules', description: '用户组拥有的规则id，多个规则","隔开', type: 'string')]
    private string $rules;

    #[OA\Property(property: 'status', description: '状态：1正常，0禁用', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'created_at', description: '创建时间', type: 'string')]
    private string $created_at;

    #[OA\Property(property: 'updated_at', description: '更新时间', type: 'string')]
    private string $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getRules(): string
    {
        return $this->rules;
    }

    public function setRules(string $rules): void
    {
        $this->rules = $rules;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
