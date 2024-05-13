<?php

declare(strict_types=1);

namespace App\Console;

use Flame\Console\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    public function __construct()
    {
        parent::__construct();

        $commands = array_merge(
            glob(__DIR__.'/Commands/*Command.php'),
            glob(app_path('Bundles/*/Commands/*Command.php'))
        );

        parent::registerCommands($commands);
    }
}
