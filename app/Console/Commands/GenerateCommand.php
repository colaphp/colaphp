<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Console\Kernel;
use Cola\Database\DB;
use Cola\Support\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Kernel
{
    /**
     * @var string
     */
    protected static $defaultName = 'gen:dao';

    /**
     * 忽略表
     *
     * @var array
     */
    private array $ignoreTable = [
        'migrations',
    ];

    /**
     * Configures the current command.
     */
    protected function configure()
    {
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->connection();

        $tables = DB::select('show tables');
        $db = env('DB_DATABASE');
        foreach ($tables as $item) {
            $key = 'Tables_in_'.$db;
            $table = $item->{$key};
            if (Str::endsWith($table, '_relation') || in_array($table, $this->ignoreTable)) {
                continue;
            }
            $model = Str::studly($table);
            $this->entity($model.'Entity', $table, $db);
            $this->model($model, $table);
        }

        return Command::SUCCESS;
    }

    /**
     * @param $entity
     * @param $table
     * @param $database
     * @return void
     */
    private function entity($entity, $table, $database): void
    {
        $content = '';
        $methods = '';

        $info = DB::select("select COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT from information_schema.COLUMNS where table_name = '{$table}' and table_schema = '{$database}';");
        foreach ($info as $column) {
            $field = $column->COLUMN_NAME;
            $method = Str::studly($field);
            $type = $column->DATA_TYPE;
            if (in_array($type, ['bigint', 'tinyint'])) {
                $type = 'int';
            }
            if (in_array($type, ['varchar', 'char', 'text', 'mediumtext', 'longtext'])) {
                $type = 'string';
            }
            if (in_array($type, ['decimal', 'float'])) {
                $type = 'float';
            }
            if (in_array($type, ['datetime', 'date'])) {
                $type = '\DateTime';
            }
            $comment = $column->COLUMN_COMMENT;

            $content .= <<<EOF

    /**
     * @var {$type} {$comment}
     */
    public {$type} \${$field};
EOF;
            $content .= PHP_EOL;
            // 方法注解
            $comment = str_replace(['(', '（', ')', '）'], [' '], $comment);
            $methods .= <<<EOF

    /**
     * 获取{$comment}
     * @return {$type}
     */
    public function get{$method}(): {$type}
    {
        return \$this->{$field};
    }

    /**
     * 设置{$comment}
     * @param {$type} \$value
     */
    public function set{$method}({$type} \$value): void
    {
        \$this->{$field} = \$value;
    }
EOF;
            $methods .= PHP_EOL;
        }

        $namespace = 'App\Entity';
        $persistentContent = <<<EOF
<?php // Code generated by gen:dao CLI tool. DO NOT EDIT.

declare(strict_types=1);

namespace {$namespace};

use App\\Support\\ArrayObject;

/**
 * Class {$entity}
 */
class {$entity} extends ArrayObject
{
{$content}{$methods}
}
EOF;
        $folder = app_path('Entity');
        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        file_put_contents($folder.'/'.$entity.'.php', $persistentContent);
    }

    /**
     * @param $model
     * @param $table
     * @return void
     */
    private function model($model, $table): void
    {
        $namespace = 'App\Model';
        $content = <<<EOF
<?php // Code generated by gen:dao CLI tool. DO NOT EDIT.

declare(strict_types=1);

namespace {$namespace};

use Cola\\Database\\Model;

/**
 * Class {$model}
 * @package {$namespace}
 */
class {$model} extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected \$table = '{$table}';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected \$primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public \$timestamps = false;
}
EOF;

        $folder = app_path('Model');
        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        file_put_contents($folder.'/'.$model.'.php', $content);
    }
}