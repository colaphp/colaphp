<?php

declare(strict_types=1);

namespace App\Entities;

use App\Support\ArrayObject;

/**
 * Class UserEntity
 */
class UserEntity extends ArrayObject
{

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string UUID
     */
    public string $uuid;

    /**
     * @var string 昵称
     */
    public string $name;

    /**
     * @var string 头像
     */
    public string $avatar;

    /**
     * @var \DateTime 生日
     */
    public \DateTime $birthday;

    /**
     * @var string 座右铭
     */
    public string $motto;

    /**
     * @var string 等级
     */
    public string $level;

    /**
     * @var float 余额
     */
    public float $money;

    /**
     * @var int 积分
     */
    public int $score;

    /**
     * @var \DateTime 注册时间
     */
    public \DateTime $join_time;

    /**
     * @var string 注册IP
     */
    public string $join_ip;

    /**
     * @var \DateTime 上次登录时间
     */
    public \DateTime $last_time;

    /**
     * @var string 上次登录IP
     */
    public string $last_ip;

    /**
     * @var \DateTime 创建时间
     */
    public \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    public \DateTime $updated_at;

    /**
     * @var \DateTime
     */
    public \DateTime $deleted_at;

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
     * 获取UUID
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * 设置UUID
     * @param string $value
     */
    public function setUuid(string $value): void
    {
        $this->uuid = $value;
    }

    /**
     * 获取昵称
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置昵称
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * 获取头像
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * 设置头像
     * @param string $value
     */
    public function setAvatar(string $value): void
    {
        $this->avatar = $value;
    }

    /**
     * 获取生日
     * @return \DateTime
     */
    public function getBirthday(): \DateTime
    {
        return $this->birthday;
    }

    /**
     * 设置生日
     * @param \DateTime $value
     */
    public function setBirthday(\DateTime $value): void
    {
        $this->birthday = $value;
    }

    /**
     * 获取座右铭
     * @return string
     */
    public function getMotto(): string
    {
        return $this->motto;
    }

    /**
     * 设置座右铭
     * @param string $value
     */
    public function setMotto(string $value): void
    {
        $this->motto = $value;
    }

    /**
     * 获取等级
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * 设置等级
     * @param string $value
     */
    public function setLevel(string $value): void
    {
        $this->level = $value;
    }

    /**
     * 获取余额
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * 设置余额
     * @param float $value
     */
    public function setMoney(float $value): void
    {
        $this->money = $value;
    }

    /**
     * 获取积分
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * 设置积分
     * @param int $value
     */
    public function setScore(int $value): void
    {
        $this->score = $value;
    }

    /**
     * 获取注册时间
     * @return \DateTime
     */
    public function getJoinTime(): \DateTime
    {
        return $this->join_time;
    }

    /**
     * 设置注册时间
     * @param \DateTime $value
     */
    public function setJoinTime(\DateTime $value): void
    {
        $this->join_time = $value;
    }

    /**
     * 获取注册IP
     * @return string
     */
    public function getJoinIp(): string
    {
        return $this->join_ip;
    }

    /**
     * 设置注册IP
     * @param string $value
     */
    public function setJoinIp(string $value): void
    {
        $this->join_ip = $value;
    }

    /**
     * 获取上次登录时间
     * @return \DateTime
     */
    public function getLastTime(): \DateTime
    {
        return $this->last_time;
    }

    /**
     * 设置上次登录时间
     * @param \DateTime $value
     */
    public function setLastTime(\DateTime $value): void
    {
        $this->last_time = $value;
    }

    /**
     * 获取上次登录IP
     * @return string
     */
    public function getLastIp(): string
    {
        return $this->last_ip;
    }

    /**
     * 设置上次登录IP
     * @param string $value
     */
    public function setLastIp(string $value): void
    {
        $this->last_ip = $value;
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

    /**
     * 获取
     * @return \DateTime
     */
    public function getDeletedAt(): \DateTime
    {
        return $this->deleted_at;
    }

    /**
     * 设置
     * @param \DateTime $value
     */
    public function setDeletedAt(\DateTime $value): void
    {
        $this->deleted_at = $value;
    }

}
