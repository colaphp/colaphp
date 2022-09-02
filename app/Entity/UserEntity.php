<?php

declare(strict_types=1);

namespace App\Entity;

use App\Support\ArrayObject;

/**
 * Class UserEntity
 *
 * @method getId() 
 * @method setId(int $value)
 * @method getUuid() UUID
 * @method setUuid(string $value)
 * @method getName() 昵称
 * @method setName(string $value)
 * @method getAvatar() 头像
 * @method setAvatar(string $value)
 * @method getBirthday() 生日
 * @method setBirthday(\DateTime $value)
 * @method getMotto() 座右铭
 * @method setMotto(string $value)
 * @method getLevel() 等级
 * @method setLevel(string $value)
 * @method getMoney() 余额
 * @method setMoney(float $value)
 * @method getScore() 积分
 * @method setScore(int $value)
 * @method getJoinTime() 注册时间
 * @method setJoinTime(\DateTime $value)
 * @method getJoinIp() 注册IP
 * @method setJoinIp(string $value)
 * @method getLastTime() 上次登录时间
 * @method setLastTime(\DateTime $value)
 * @method getLastIp() 上次登录IP
 * @method setLastIp(string $value)
 * @method getCreatedAt() 创建时间
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 更新时间
 * @method setUpdatedAt(\DateTime $value)
 * @method getDeletedAt() 
 * @method setDeletedAt(\DateTime $value)
 * @package App\Entity
 */
class UserEntity extends ArrayObject
{

    /**
     * @var int 
     */
    private int $id;

    /**
     * @var string UUID
     */
    private string $uuid;

    /**
     * @var string 昵称
     */
    private string $name;

    /**
     * @var string 头像
     */
    private string $avatar;

    /**
     * @var \DateTime 生日
     */
    private \DateTime $birthday;

    /**
     * @var string 座右铭
     */
    private string $motto;

    /**
     * @var string 等级
     */
    private string $level;

    /**
     * @var float 余额
     */
    private float $money;

    /**
     * @var int 积分
     */
    private int $score;

    /**
     * @var \DateTime 注册时间
     */
    private \DateTime $join_time;

    /**
     * @var string 注册IP
     */
    private string $join_ip;

    /**
     * @var \DateTime 上次登录时间
     */
    private \DateTime $last_time;

    /**
     * @var string 上次登录IP
     */
    private string $last_ip;

    /**
     * @var \DateTime 创建时间
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    private \DateTime $updated_at;

    /**
     * @var \DateTime 
     */
    private \DateTime $deleted_at;

}