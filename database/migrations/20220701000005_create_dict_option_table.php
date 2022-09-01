<?php

declare(strict_types=1);

use Cola\Database\Migration\DB\Column;
use Phinx\Migration\AbstractMigration;

final class CreateDictOptionTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('dict_option', [
            'signed' => false,
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '选项表',
        ]);

        $table->addColumn(Column::string('name')->setComment('键'))
            ->addColumn(Column::longText('value')->setComment('值'))
            ->addColumn(Column::dateTime('created_at')->setComment('上次登录IP'))
            ->addColumn(Column::dateTime('updated_at')->setNullable()->setComment('上次登录IP'))
            ->create();

        $this->table('dict_option')->insert([
            'name' => 'table_form_schema_test',
            'value' => '',
            'created_at' => date('Y-m-d H:i:s'),
        ])->saveData();
    }
}
