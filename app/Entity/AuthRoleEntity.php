<?php

declare(strict_types=1);

namespace App\Entity;

use App\Http\Traits\SimpleAccess;

/**
 * Class AuthRoleEntity
 *
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
 * @method getCreatedAt() 创建时间
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 更新时间
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
     * @var \DateTime 创建时间
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    private \DateTime $updated_at;

}