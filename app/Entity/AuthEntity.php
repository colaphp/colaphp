<?php

declare(strict_types=1);

namespace App\Entity;

use App\Support\ArrayObject;

/**
 * Class AuthEntity
 */
class AuthEntity extends ArrayObject
{

    /**
     * @var int 
     */
    public int $id;

    /**
     * @var int 用户ID
     */
    public int $user_id;

    /**
     * @var string 认证类型:username,email,mobile,wechat
     */
    public string $type;

    /**
     * @var string 通行证:手机号/邮箱/用户名或第三方应用的唯一标识
     */
    public string $passport;

    /**
     * @var string 密码凭证或token
     */
    public string $password;

    /**
     * @var int 是否已经验证
     */
    public int $verified;

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
     * 获取用户ID
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * 设置用户ID
     * @param int $value
     */
    public function setUserId(int $value): void
    {
        $this->user_id = $value;
    }

    /**
     * 获取认证类型:username,email,mobile,wechat
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * 设置认证类型:username,email,mobile,wechat
     * @param string $value
     */
    public function setType(string $value): void
    {
        $this->type = $value;
    }

    /**
     * 获取通行证:手机号/邮箱/用户名或第三方应用的唯一标识
     * @return string
     */
    public function getPassport(): string
    {
        return $this->passport;
    }

    /**
     * 设置通行证:手机号/邮箱/用户名或第三方应用的唯一标识
     * @param string $value
     */
    public function setPassport(string $value): void
    {
        $this->passport = $value;
    }

    /**
     * 获取密码凭证或token
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * 设置密码凭证或token
     * @param string $value
     */
    public function setPassword(string $value): void
    {
        $this->password = $value;
    }

    /**
     * 获取是否已经验证
     * @return int
     */
    public function getVerified(): int
    {
        return $this->verified;
    }

    /**
     * 设置是否已经验证
     * @param int $value
     */
    public function setVerified(int $value): void
    {
        $this->verified = $value;
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