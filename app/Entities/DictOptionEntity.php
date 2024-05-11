<?php

declare(strict_types=1);

namespace App\Entities;

use App\Support\ArrayObject;

/**
 * Class DictOptionEntity
 */
class DictOptionEntity extends ArrayObject
{

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string 键
     */
    public string $name;

    /**
     * @var string 值
     */
    public string $value;

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
     * 获取键
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置键
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * 获取值
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * 设置值
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
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
