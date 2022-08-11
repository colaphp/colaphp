<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateAuthRuleTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('auth_rule', [
            'signed' => false,
            'collation' => 'utf8mb4_general_ci',
            'comment' => '权限表',
        ]);

        $table->addColumn(Column::string('group')->setComment('规则分组'))
            ->addColumn(Column::string('rule')->setUnique()->setComment('规则标识（唯一）'))
            ->addColumn(Column::string('description')->setComment('规则描述'))
            ->addColumn(Column::tinyInteger('type')->setComment('验证类型'))
            ->addColumn(Column::tinyInteger('status')->setComment('状态：1正常，0禁用'))
            ->addColumn(Column::string('condition')->setComment('规则表达式，为空表示存在就验证，不为空表示按照条件验证'))
            ->addTimestamps()
            ->create();
    }
}
