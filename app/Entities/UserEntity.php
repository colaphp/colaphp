<?php

declare(strict_types=1);

namespace App\Entities;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserEntity')]
class UserEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'uuid', description: 'UUID', type: 'string')]
    private string $uuid;

    #[OA\Property(property: 'name', description: '昵称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'mobile', description: '手机号码', type: 'string')]
    private string $mobile;

    #[OA\Property(property: 'mobile_verified_at', description: '手机号码验证时间', type: 'string')]
    private string $mobile_verified_at;

    #[OA\Property(property: 'avatar', description: '头像', type: 'string')]
    private string $avatar;

    #[OA\Property(property: 'birthday', description: '生日', type: 'string')]
    private string $birthday;

    #[OA\Property(property: 'motto', description: '座右铭', type: 'string')]
    private string $motto;

    #[OA\Property(property: 'level', description: '等级', type: 'string')]
    private string $level;

    #[OA\Property(property: 'money', description: '余额', type: 'float')]
    private float $money;

    #[OA\Property(property: 'score', description: '积分', type: 'integer')]
    private int $score;

    #[OA\Property(property: 'status', description: '状态：1正常，2禁用', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'join_time', description: '注册时间', type: 'string')]
    private string $join_time;

    #[OA\Property(property: 'join_ip', description: '注册IP', type: 'string')]
    private string $join_ip;

    #[OA\Property(property: 'last_time', description: '上次登录时间', type: 'string')]
    private string $last_time;

    #[OA\Property(property: 'last_ip', description: '上次登录IP', type: 'string')]
    private string $last_ip;

    #[OA\Property(property: 'created_at', description: '创建时间', type: 'string')]
    private string $created_at;

    #[OA\Property(property: 'updated_at', description: '更新时间', type: 'string')]
    private string $updated_at;

    #[OA\Property(property: 'deleted_at', description: '删除时间', type: 'string')]
    private string $deleted_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getMobileVerifiedAt(): string
    {
        return $this->mobile_verified_at;
    }

    public function setMobileVerifiedAt(string $mobile_verified_at): void
    {
        $this->mobile_verified_at = $mobile_verified_at;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getMotto(): string
    {
        return $this->motto;
    }

    public function setMotto(string $motto): void
    {
        $this->motto = $motto;
    }

    public function getLevel(): string
    {
        return $this->level;
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    public function getMoney(): float
    {
        return $this->money;
    }

    public function setMoney(float $money): void
    {
        $this->money = $money;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getJoinTime(): string
    {
        return $this->join_time;
    }

    public function setJoinTime(string $join_time): void
    {
        $this->join_time = $join_time;
    }

    public function getJoinIp(): string
    {
        return $this->join_ip;
    }

    public function setJoinIp(string $join_ip): void
    {
        $this->join_ip = $join_ip;
    }

    public function getLastTime(): string
    {
        return $this->last_time;
    }

    public function setLastTime(string $last_time): void
    {
        $this->last_time = $last_time;
    }

    public function getLastIp(): string
    {
        return $this->last_ip;
    }

    public function setLastIp(string $last_ip): void
    {
        $this->last_ip = $last_ip;
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

    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    public function setDeletedAt(string $deleted_at): void
    {
        $this->deleted_at = $deleted_at;
    }
}
