<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateAuthTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('auth', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户认证表',
        ]);

        $table->addColumn(Column::unsignedInteger('user_id')->setComment('用户ID'))
            ->addColumn(Column::string('type', 32)->setComment('认证类型:username,email,mobile,wechat'))
            ->addColumn(Column::string('passport', 64)->setUnique()->setComment('通行证:手机号/邮箱/用户名或第三方应用的唯一标识'))
            ->addColumn(Column::string('password')->setNullable()->setComment('密码凭证或token'))
            ->addColumn(Column::tinyInteger('verified')->setDefault(0)->setComment('是否已经验证'))
            ->addColumn(Column::dateTime('created_at')->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('上次登录IP'))
            ->create();

        $this->table('auth')->insert([
            'user_id' => 99,
            'type' => 'username',
            'passport' => 'root',
            'password' => password_hash('123456aA', PASSWORD_DEFAULT),
            'verified' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ])->saveData();
    }
}
