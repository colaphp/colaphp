<?php

declare(strict_types=1);

namespace App\Entity;

use App\Support\ArrayObject;

/**
 * Class AuthEntity
 *
 * @method getId() 
 * @method setId(int $value)
 * @method getUserId() 用户ID
 * @method setUserId(int $value)
 * @method getType() 认证类型:username,email,mobile,wechat
 * @method setType(string $value)
 * @method getPassport() 通行证:手机号/邮箱/用户名或第三方应用的唯一标识
 * @method setPassport(string $value)
 * @method getPassword() 密码凭证或token
 * @method setPassword(string $value)
 * @method getVerified() 是否已经验证
 * @method setVerified(int $value)
 * @method getCreatedAt() 创建时间
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 更新时间
 * @method setUpdatedAt(\DateTime $value)
 * @package App\Entity
 */
class AuthEntity extends ArrayObject
{

    /**
     * @var int 
     */
    private int $id;

    /**
     * @var int 用户ID
     */
    private int $user_id;

    /**
     * @var string 认证类型:username,email,mobile,wechat
     */
    private string $type;

    /**
     * @var string 通行证:手机号/邮箱/用户名或第三方应用的唯一标识
     */
    private string $passport;

    /**
     * @var string 密码凭证或token
     */
    private string $password;

    /**
     * @var int 是否已经验证
     */
    private int $verified;

    /**
     * @var \DateTime 创建时间
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    private \DateTime $updated_at;

}