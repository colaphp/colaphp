<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateUserRoleRelationTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_role_relation', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户角色关联表',
        ]);

        $table->addColumn(Column::unsignedInteger('user_id')->setComment('用户id'))
            ->addColumn(Column::unsignedInteger('auth_role_id')->setComment('角色id'))
            ->create();

        $this->table('user_role_relation')->insert([
            'user_id' => 99,
            'auth_role_id' => 1,
        ])->saveData();
    }
}
