<?php

declare(strict_types=1);

namespace App\Entity;

use App\Http\Traits\SimpleAccess;

/**
 * Class DictOptionEntity
 *
 * @method getId() 
 * @method setId(int $value)
 * @method getName() 键
 * @method setName(string $value)
 * @method getValue() 值
 * @method setValue(string $value)
 * @method getCreatedAt() 上次登录IP
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 上次登录IP
 * @method setUpdatedAt(\DateTime $value)
 * @package App\Entity
 */
class DictOptionEntity
{
    use SimpleAccess;
    
    /**
     * @var int 
     */
    private int $id;

    /**
     * @var string 键
     */
    private string $name;

    /**
     * @var string 值
     */
    private string $value;

    /**
     * @var \DateTime 上次登录IP
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 上次登录IP
     */
    private \DateTime $updated_at;

}