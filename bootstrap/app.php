<?php

declare(strict_types=1);

const VERSION = 'v1.0.0';
const RELEASE = '20220630';

use Cola\Foundation\Console\ServeCommand;
use Phinx\Console\Command;
use Symfony\Component\Console\Application;

try {
    $cli = new Application('ColaPHP Console');
    $cli->setCatchExceptions(true);

    $cli->add(new ServeCommand());
    $commands = glob(app_path('Console/Commands/*.php'));
    $pattern = '/(app\/Console\/Commands\/.+?)\.php/';
    foreach ($commands as $file) {
        preg_match($pattern, str_replace('\\', '/', $file), $matches);
        if (isset($matches[1])) {
            $command = ucfirst(str_replace('/', '\\', $matches[1]));
            $cli->add(new $command());
        }
    }

    $cli->addCommands([
        new Command\Create(),
        new Command\Migrate(),
        new Command\Rollback(),
        new Command\Status(),
        new Command\SeedCreate(),
        new Command\SeedRun(),
    ]);

    $cli->run();
} catch (Exception $e) {
    die($e->getMessage() . PHP_EOL);
}
