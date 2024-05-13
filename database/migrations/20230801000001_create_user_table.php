<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户表',
        ]);

        $table->addColumn(Column::string('name')->setDefault('')->setNull(false)->setComment('昵称'))
            ->addColumn(Column::string('avatar')->setDefault('')->setNull(false)->setComment('头像'))
            ->addColumn(Column::date('birthday')->setNullable()->setComment('生日'))
            ->addColumn(Column::string('mobile')->setDefault('')->setNull(false)->setComment('手机号码'))
            ->addColumn(Column::dateTime('mobile_verified_at')->setNullable()->setComment('手机号码验证时间'))
            ->addColumn(Column::unsignedTinyInteger('status')->setNull(false)->setComment('状态（1正常，2禁用）'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNullable()->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_time')->setNullable()->setComment('删除时间'))
            ->addIndex(['mobile', 'deleted_time'], ['unique' => true, 'name' => 'mobile'])
            ->create();
    }
}
