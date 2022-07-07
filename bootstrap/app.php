<?php

declare(strict_types=1);

if (version_compare(PHP_VERSION, '8.0.2', '<')) {
    exit('Require a PHP version ">= 8.0.2". You are running ' . PHP_VERSION . '.');
}

const VERSION = 'v1.0.0';
const RELEASE = '20220630';

use Cola\Foundation\Console\ServeCommand;
use Phinx\Console\Command\Create;
use Phinx\Console\Command\Migrate;
use Phinx\Console\Command\Rollback;
use Phinx\Console\Command\SeedCreate;
use Phinx\Console\Command\SeedRun;
use Phinx\Console\Command\Status;
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
        new Create(),
        new Migrate(),
        new Rollback(),
        new Status(),
        new SeedCreate(),
        new SeedRun(),
    ]);

    $cli->run();
} catch (Exception $e) {
    die($e->getMessage() . PHP_EOL);
}
