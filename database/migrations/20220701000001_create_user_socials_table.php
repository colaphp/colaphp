<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateUserSocialsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('user_socials', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '用户认证表',
        ]);

        $table->addColumn(Column::unsignedInteger('user_id')->setDefault(0)->setNull(false)->setComment('用户ID'))
            ->addColumn(Column::string('provider')->setDefault('')->setNull(false)->setComment('认证类型:username,email,mobile,wechat'))
            ->addColumn(Column::string('provider_user_id')->setDefault('')->setNull(false)->setComment('通行证:手机号/邮箱/用户名或第三方应用的唯一标识'))
            ->addColumn(Column::string('access_token')->setDefault('')->setNull(false)->setComment('访问令牌'))
            ->addColumn(Column::string('refresh_token')->setDefault('')->setNull(false)->setComment('刷新令牌'))
            ->addColumn(Column::unsignedInteger('expires_in')->setDefault(0)->setNull(false)->setComment('访问令牌过期时间（秒）'))
            ->addColumn(Column::dateTime('token_created_at')->setComment('访问令牌创建时间'))
            ->addColumn(Column::dateTime('created_at')->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('更新时间'))
            ->addIndex(['user_id'], ['name' => 'user_id'])
            ->addIndex(['provider', 'provider_user_id'], ['unique' => true, 'name' => 'provider_user_id'])
            ->create();
    }
}
