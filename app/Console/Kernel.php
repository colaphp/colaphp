<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Console\Command\Command;

abstract class Kernel extends Command
{
    /**
     * @return void
     */
    protected function connection(): void
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
