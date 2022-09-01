<?php

namespace App\Entity;

use App\Http\Traits\SimpleAccess;

/**
 * Class AuthRoleEntity
 * @method getId() 
 * @method setId(int $value)
 * @method getName() 角色名称
 * @method setName(string $value)
 * @method getDescription() 角色描述
 * @method setDescription(string $value)
 * @method getRules() 用户组拥有的规则id，多个规则","隔开
 * @method setRules(string $value)
 * @method getStatus() 状态：1正常，0禁用
 * @method setStatus(int $value)
 * @method getCreatedAt() 上次登录IP
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 上次登录IP
 * @method setUpdatedAt(\DateTime $value)
 * @package App\Entity
 */
class AuthRoleEntity
{
    use SimpleAccess;
    
    /**
     * @var int 
     */
    private int $id;

    /**
     * @var string 角色名称
     */
    private string $name;

    /**
     * @var string 角色描述
     */
    private string $description;

    /**
     * @var string 用户组拥有的规则id，多个规则","隔开
     */
    private string $rules;

    /**
     * @var int 状态：1正常，0禁用
     */
    private int $status;

    /**
     * @var \DateTime 上次登录IP
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 上次登录IP
     */
    private \DateTime $updated_at;

}