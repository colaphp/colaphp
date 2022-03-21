<?php

namespace App\Console\Commands;

use Illuminate\Database\Capsule\Manager as Capsule;
use Swift\Database\DB;
use Swift\Support\Str;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GenerateCommand
 * @package App\Console\Commands
 */
class GenerateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'gen:dao';

    /**
     * 忽略表
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
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->connection();

        $tables = DB::select('show tables');
        $db = env('DB_DATABASE');
        foreach ($tables as $item) {
            $key = 'Tables_in_' . $db;
            $table = $item->$key;
            if (Str::endsWith($table, '_relation') || in_array($table, $this->ignoreTable)) {
                continue;
            }
            $model = Str::studly($table);
            $this->entity($model . 'Entity', $table, $db);
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
    private function entity($entity, $table, $database)
    {
        $annotation = '';
        $content = '';

        $info = DB::select("select COLUMN_NAME,DATA_TYPE,COLUMN_COMMENT from information_schema.COLUMNS where table_name = '$table' and table_schema = '$database';");
        foreach ($info as $column) {
            $field = $column->COLUMN_NAME;
            $method = Str::studly($field);
            $type = $column->DATA_TYPE;
            if (in_array($type, ['bigint', 'tinyint'])) {
                $type = 'int';
            }
            if (in_array($type, ['varchar', 'char', 'text', 'mediumtext'])) {
                $type = 'string';
            }
            if ($type == 'decimal') {
                $type = 'float';
            }
            if ($type == 'datetime') {
                $type = '\DateTime';
            }
            $comment = $column->COLUMN_COMMENT;

            $content .= <<<EOF

    /**
     * @var $type $comment
     */
    private $type \$$field;
EOF;
            $content .= PHP_EOL;
            // 方法注解
            $comment = str_replace(['(', '（', ')', '）'], [' '], $comment);
            $annotation .= <<<EOF
 * @method get$method() $comment
 * @method set$method($type \$value)
EOF;
            $annotation .= PHP_EOL;

        }

        $namespace = 'App\Entity';
        $persistentContent = <<<EOF
<?php

namespace $namespace;

use App\Support\SimpleAccess;

/**
 * Class $entity
$annotation * @package $namespace
 */
class $entity
{
    use SimpleAccess;
    $content
}
EOF;
        $folder = app_path('Entity');
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        file_put_contents($folder . '/' . $entity . '.php', $persistentContent);
    }

    /**
     * @param $model
     * @param $table
     * @return void
     */
    private function model($model, $table)
    {
        $namespace = 'App\Models';
        $content = <<<EOF
<?php

namespace $namespace;

use Swift\Database\Model;

/**
 * Class $model
 * @package $namespace
 */
class $model extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected \$table = '$table';

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

        $folder = app_path('Models');
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        file_put_contents($folder . '/' . $model . '.php', $content);
    }

    /**
     * @return void
     */
    private function connection()
    {
        $database = require config_path('database.php');

        $capsule = new Capsule();
        if (isset($database['default'])) {
            $default_config = $database['connections'][$database['default']];
            $capsule->addConnection($default_config);
        }

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
