<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户表',
        ]);

        $table->addColumn(Column::uuid('uuid')->setNull(false)->setComment('UUID'))
            ->addColumn(Column::string('name')->setDefault('')->setNull(false)->setComment('昵称'))
            ->addColumn(Column::string('mobile')->setDefault('')->setNull(false)->setComment('手机号码'))
            ->addColumn(Column::dateTime('mobile_verified_at')->setNullable()->setComment('手机号码验证时间'))
            ->addColumn(Column::string('avatar')->setDefault('')->setNull(false)->setComment('头像'))
            ->addColumn(Column::date('birthday')->setComment('生日'))
            ->addColumn(Column::string('motto')->setDefault('')->setNull(false)->setComment('座右铭'))
            ->addColumn(Column::string('level')->setDefault(0)->setNull(false)->setComment('等级'))
            ->addColumn(Column::decimal('money')->setDefault(0)->setNull(false)->setComment('余额'))
            ->addColumn(Column::unsignedInteger('score')->setDefault(0)->setNull(false)->setComment('积分'))
            ->addColumn(Column::unsignedTinyInteger('status')->setDefault(0)->setNull(false)->setComment('状态：1正常，2禁用'))
            ->addColumn(Column::dateTime('join_time')->setNull(false)->setComment('注册时间'))
            ->addColumn(Column::string('join_ip')->setDefault('')->setNull(false)->setComment('注册IP'))
            ->addColumn(Column::dateTime('last_time')->setComment('上次登录时间'))
            ->addColumn(Column::string('last_ip')->setDefault('')->setNull(false)->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('created_at')->setNull(false)->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_at')->setNullable()->setComment('删除时间'))
            ->addIndex(['mobile'], ['unique' => true, 'name' => 'mobile'])
            ->addIndex(['created_at'], ['name' => 'created_at'])
            ->create();
    }
}
