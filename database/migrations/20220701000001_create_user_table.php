<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user', [
            'signed' => false,
            'collation' => 'utf8mb4_general_ci',
            'comment' => '用户表',
        ]);

        $table->addColumn(Column::uuid('openid')->setUnique()->setComment('OpenID'))
            ->addColumn(Column::string('name')->setComment('昵称'))
            ->addColumn(Column::string('avatar')->setComment('头像'))
            ->addColumn(Column::date('birthday')->setComment('生日'))
            ->addColumn(Column::string('motto')->setComment('座右铭'))
            ->addTimestamps()
            ->addColumn(Column::timestamp('deleted_at')->setNullable())
            ->create();
    }
}
