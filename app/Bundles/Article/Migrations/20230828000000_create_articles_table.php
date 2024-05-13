<?php

declare(strict_types=1);

use Flame\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

class CreateArticlesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('articles', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '文章表',
        ]);

        $table->addColumn(Column::string('title')->setDefault('')->setNull(false)->setComment('文章标题'))
            ->addColumn(Column::string('image')->setNull(false)->setComment('文章海报'))
            ->addColumn(Column::text('content')->setNull(false)->setComment('文章描述'))
            ->addColumn(Column::unsignedTinyInteger('status')->setNull(false)->setComment('状态（1正常，2禁用）'))
            ->addColumn(Column::dateTime('created_time')->setNull(false)->setComment('创建时间'))
            ->addColumn(Column::dateTime('updated_time')->setNullable()->setComment('更新时间'))
            ->addColumn(Column::dateTime('deleted_time')->setNullable()->setComment('删除时间'))
            ->create();
    }
}
