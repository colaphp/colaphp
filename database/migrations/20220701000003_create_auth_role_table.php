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
            'collation' => 'utf8mb4_general_ci',
            'comment' => '角色表',
        ]);

        $table->addColumn(Column::string('name')->setComment('角色名称'))
            ->addColumn(Column::string('description')->setComment('角色描述'))
            ->addColumn(Column::string('rules')->setComment('用户组拥有的规则id，多个规则","隔开'))
            ->addColumn(Column::tinyInteger('status')->setComment('状态：1正常，0禁用'))
            ->addTimestamps()
            ->create();
    }
}
