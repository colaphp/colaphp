<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreatePermissionsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('permissions', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '权限表',
        ]);

        $table->addColumn(Column::string('module')->setComment('模块'))
            ->addColumn(Column::string('title')->setComment('标题'))
            ->addColumn(Column::string('name')->setUnique()->setComment('key'))
            ->addColumn(Column::unsignedInteger('parent_id')->setDefault(0)->setComment('上级菜单'))
            ->addColumn(Column::string('component')->setDefault('LAYOUT')->setComment('前端组件'))
            ->addColumn(Column::string('path')->setComment('路径'))
            ->addColumn(Column::string('icon')->setNullable()->setComment('图标'))
            ->addColumn(Column::string('frame_src')->setNullable()->setComment('url'))
            ->addColumn(Column::tinyInteger('hide_menu')->setDefault(0)->setComment('隐藏菜单'))
            ->addColumn(Column::tinyInteger('is_menu')->setDefault(1)->setComment('是否菜单'))
            ->addColumn(Column::dateTime('created_at')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('更新时间'))
            ->create();
    }
}
