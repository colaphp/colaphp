<?php

declare(strict_types=1);

namespace App\Entities;

use App\Support\ArrayObject;

/**
 * Class AuthRuleEntity
 */
class AuthRuleEntity extends ArrayObject
{

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string 模块
     */
    public string $module;

    /**
     * @var string 标题
     */
    public string $title;

    /**
     * @var string key
     */
    public string $name;

    /**
     * @var int 上级菜单
     */
    public int $parent_id;

    /**
     * @var string 前端组件
     */
    public string $component;

    /**
     * @var string 路径
     */
    public string $path;

    /**
     * @var string 图标
     */
    public string $icon;

    /**
     * @var string url
     */
    public string $frame_src;

    /**
     * @var int 隐藏菜单
     */
    public int $hide_menu;

    /**
     * @var int 是否菜单
     */
    public int $is_menu;

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
     * 获取模块
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * 设置模块
     * @param string $value
     */
    public function setModule(string $value): void
    {
        $this->module = $value;
    }

    /**
     * 获取标题
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * 设置标题
     * @param string $value
     */
    public function setTitle(string $value): void
    {
        $this->title = $value;
    }

    /**
     * 获取key
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置key
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * 获取上级菜单
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parent_id;
    }

    /**
     * 设置上级菜单
     * @param int $value
     */
    public function setParentId(int $value): void
    {
        $this->parent_id = $value;
    }

    /**
     * 获取前端组件
     * @return string
     */
    public function getComponent(): string
    {
        return $this->component;
    }

    /**
     * 设置前端组件
     * @param string $value
     */
    public function setComponent(string $value): void
    {
        $this->component = $value;
    }

    /**
     * 获取路径
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * 设置路径
     * @param string $value
     */
    public function setPath(string $value): void
    {
        $this->path = $value;
    }

    /**
     * 获取图标
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * 设置图标
     * @param string $value
     */
    public function setIcon(string $value): void
    {
        $this->icon = $value;
    }

    /**
     * 获取url
     * @return string
     */
    public function getFrameSrc(): string
    {
        return $this->frame_src;
    }

    /**
     * 设置url
     * @param string $value
     */
    public function setFrameSrc(string $value): void
    {
        $this->frame_src = $value;
    }

    /**
     * 获取隐藏菜单
     * @return int
     */
    public function getHideMenu(): int
    {
        return $this->hide_menu;
    }

    /**
     * 设置隐藏菜单
     * @param int $value
     */
    public function setHideMenu(int $value): void
    {
        $this->hide_menu = $value;
    }

    /**
     * 获取是否菜单
     * @return int
     */
    public function getIsMenu(): int
    {
        return $this->is_menu;
    }

    /**
     * 设置是否菜单
     * @param int $value
     */
    public function setIsMenu(int $value): void
    {
        $this->is_menu = $value;
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
