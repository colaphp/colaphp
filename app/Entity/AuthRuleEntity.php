<?php

declare(strict_types=1);

namespace App\Entity;

use App\Support\ArrayObject;

/**
 * Class AuthRuleEntity
 *
 * @method getId() 
 * @method setId(int $value)
 * @method getModule() 模块
 * @method setModule(string $value)
 * @method getTitle() 标题
 * @method setTitle(string $value)
 * @method getName() key
 * @method setName(string $value)
 * @method getParentId() 上级菜单
 * @method setParentId(int $value)
 * @method getComponent() 前端组件
 * @method setComponent(string $value)
 * @method getPath() 路径
 * @method setPath(string $value)
 * @method getIcon() 图标
 * @method setIcon(string $value)
 * @method getFrameSrc() url
 * @method setFrameSrc(string $value)
 * @method getHideMenu() 隐藏菜单
 * @method setHideMenu(int $value)
 * @method getIsMenu() 是否菜单
 * @method setIsMenu(int $value)
 * @method getCreatedAt() 创建时间
 * @method setCreatedAt(\DateTime $value)
 * @method getUpdatedAt() 更新时间
 * @method setUpdatedAt(\DateTime $value)
 * @package App\Entity
 */
class AuthRuleEntity extends ArrayObject
{

    /**
     * @var int 
     */
    private int $id;

    /**
     * @var string 模块
     */
    private string $module;

    /**
     * @var string 标题
     */
    private string $title;

    /**
     * @var string key
     */
    private string $name;

    /**
     * @var int 上级菜单
     */
    private int $parent_id;

    /**
     * @var string 前端组件
     */
    private string $component;

    /**
     * @var string 路径
     */
    private string $path;

    /**
     * @var string 图标
     */
    private string $icon;

    /**
     * @var string url
     */
    private string $frame_src;

    /**
     * @var int 隐藏菜单
     */
    private int $hide_menu;

    /**
     * @var int 是否菜单
     */
    private int $is_menu;

    /**
     * @var \DateTime 创建时间
     */
    private \DateTime $created_at;

    /**
     * @var \DateTime 更新时间
     */
    private \DateTime $updated_at;

}