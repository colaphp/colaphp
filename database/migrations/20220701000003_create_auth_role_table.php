<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateAuthRoleTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('auth_role', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户角色表',
        ]);

        $table->addColumn(Column::string('name')->setComment('角色名称'))
            ->addColumn(Column::string('description')->setComment('角色描述'))
            ->addColumn(Column::text('rules')->setComment('用户组拥有的规则id，多个规则","隔开'))
            ->addColumn(Column::tinyInteger('status')->setComment('状态：1正常，0禁用'))
            ->addColumn(Column::dateTime('created_at')->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('上次登录IP'))
            ->create();

        $this->table('auth_role')->insert([
            'id' => 1,
            'name' => '超级管理员',
            'description' => '',
            'rules' => '*',
            'status' => 1,
        ])->saveData();
    }
}
