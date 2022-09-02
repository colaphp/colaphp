<?php

declare(strict_types=1);

namespace App\Entity;

use App\Support\ArrayObject;

/**
 * Class AuthRoleEntity
 */
class AuthRoleEntity extends ArrayObject
{

    /**
     * @var int 
     */
    public int $id;

    /**
     * @var string 角色名称
     */
    public string $name;

    /**
     * @var string 角色描述
     */
    public string $description;

    /**
     * @var string 用户组拥有的规则id，多个规则","隔开
     */
    public string $rules;

    /**
     * @var int 状态：1正常，0禁用
     */
    public int $status;

    /**
     * @var \DateTime 创建时间
     */
    public \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    public \DateTime $updated_at;

    /**
     * 获取
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * 设置
     * @param int $value
     */
    public function setId(int $value): void
    {
        $this->id = $value;
    }

    /**
     * 获取角色名称
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置角色名称
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * 获取角色描述
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * 设置角色描述
     * @param string $value
     */
    public function setDescription(string $value): void
    {
        $this->description = $value;
    }

    /**
     * 获取用户组拥有的规则id，多个规则","隔开
     * @return string
     */
    public function getRules(): string
    {
        return $this->rules;
    }

    /**
     * 设置用户组拥有的规则id，多个规则","隔开
     * @param string $value
     */
    public function setRules(string $value): void
    {
        $this->rules = $value;
    }

    /**
     * 获取状态：1正常，0禁用
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * 设置状态：1正常，0禁用
     * @param int $value
     */
    public function setStatus(int $value): void
    {
        $this->status = $value;
    }

    /**
     * 获取创建时间
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * 设置创建时间
     * @param \DateTime $value
     */
    public function setCreatedAt(\DateTime $value): void
    {
        $this->created_at = $value;
    }

    /**
     * 获取更新时间
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * 设置更新时间
     * @param \DateTime $value
     */
    public function setUpdatedAt(\DateTime $value): void
    {
        $this->updated_at = $value;
    }

}