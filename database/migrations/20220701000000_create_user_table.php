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
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户表',
        ]);

        $table->addColumn(Column::uuid('uuid')->setUnique()->setComment('UUID'))
            ->addColumn(Column::string('name')->setComment('昵称'))
            ->addColumn(Column::string('avatar')->setComment('头像'))
            ->addColumn(Column::date('birthday')->setComment('生日'))
            ->addColumn(Column::string('motto')->setComment('座右铭'))
            ->addColumn(Column::string('level')->setDefault(0)->setComment('等级'))
            ->addColumn(Column::decimal('money')->setDefault(0)->setComment('余额'))
            ->addColumn(Column::unsignedInteger('score')->setDefault(0)->setComment('积分'))
            ->addColumn(Column::dateTime('join_time')->setComment('注册时间'))
            ->addColumn(Column::string('join_ip')->setComment('注册IP'))
            ->addColumn(Column::dateTime('last_time')->setComment('上次登录时间'))
            ->addColumn(Column::string('last_ip')->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('created_at')->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('deleted_at')->setNullable())
            ->create();

        $this->table('user')->insert([
            'id' => 99,
            'uuid' => '800001',
            'name' => '管理员',
            'avatar' => 'avatar',
            'birthday' => date('Y-m-d'),
            'motto' => '简介',
            'join_time' => date('Y-m-d H:i:s'),
            'join_ip' => '127.0.0.1',
            'last_time' => date('Y-m-d H:i:s'),
            'last_ip' => '127.0.0.1',
        ])->saveData();
    }
}
