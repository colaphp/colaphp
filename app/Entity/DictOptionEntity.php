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
 * @method getCreatedAt() 创建时间
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 更新时间
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
     * @var \DateTime 创建时间
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    private \DateTime $updated_at;

}