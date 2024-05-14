<?php

declare(strict_types=1);

namespace App\Entities;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'PermissionEntity')]
class PermissionEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'module', description: '模块', type: 'string')]
    private string $module;

    #[OA\Property(property: 'title', description: '标题', type: 'string')]
    private string $title;

    #[OA\Property(property: 'name', description: 'key', type: 'string')]
    private string $name;

    #[OA\Property(property: 'parent_id', description: '上级菜单', type: 'integer')]
    private int $parent_id;

    #[OA\Property(property: 'component', description: '前端组件', type: 'string')]
    private string $component;

    #[OA\Property(property: 'path', description: '路径', type: 'string')]
    private string $path;

    #[OA\Property(property: 'icon', description: '图标', type: 'string')]
    private string $icon;

    #[OA\Property(property: 'frame_src', description: 'url', type: 'string')]
    private string $frame_src;

    #[OA\Property(property: 'hide_menu', description: '隐藏菜单', type: 'integer')]
    private int $hide_menu;

    #[OA\Property(property: 'is_menu', description: '是否菜单', type: 'integer')]
    private int $is_menu;

    #[OA\Property(property: 'created_at', description: '创建时间', type: 'string')]
    private string $created_at;

    #[OA\Property(property: 'updated_at', description: '更新时间', type: 'string')]
    private string $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getModule(): string
    {
        return $this->module;
    }

    public function setModule(string $module): void
    {
        $this->module = $module;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getParentId(): int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    public function getComponent(): string
    {
        return $this->component;
    }

    public function setComponent(string $component): void
    {
        $this->component = $component;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    public function getFrameSrc(): string
    {
        return $this->frame_src;
    }

    public function setFrameSrc(string $frame_src): void
    {
        $this->frame_src = $frame_src;
    }

    public function getHideMenu(): int
    {
        return $this->hide_menu;
    }

    public function setHideMenu(int $hide_menu): void
    {
        $this->hide_menu = $hide_menu;
    }

    public function getIsMenu(): int
    {
        return $this->is_menu;
    }

    public function setIsMenu(int $is_menu): void
    {
        $this->is_menu = $is_menu;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
