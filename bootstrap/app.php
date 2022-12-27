<?php

declare(strict_types=1);

use Cola\Foundation\Console\ServeCommand;
use Dotenv\Dotenv;
use Phinx\Console\Command;
use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends SymfonyApplication
{
    const VERSION = 'v1.0.3';

    const RELEASE = '20220811';

    /**
     * Initialize the console application.
     */
    public function __construct()
    {
        parent::__construct('ColaPHP Console.');

        $this->addCommands([
            new Command\Create(),
            new Command\Migrate(),
            new Command\Rollback(),
            new Command\Status(),
            new Command\SeedCreate(),
            new Command\SeedRun(),
        ]);

        $this->add(new ServeCommand());
        $commands = glob(app_path('Console/Commands/*.php'));
        $pattern = '/(app\/Console\/Commands\/.+?)\.php/';
        foreach ($commands as $file) {
            preg_match($pattern, str_replace('\\', '/', $file), $matches);
            if (isset($matches[1])) {
                $command = ucfirst(str_replace('/', '\\', $matches[1]));
                $this->add(new $command());
            }
        }
    }
}

try {
    if (class_exists('Dotenv\Dotenv')) {
        if (method_exists('Dotenv\Dotenv', 'createUnsafeImmutable')) {
            Dotenv::createUnsafeImmutable(base_path())->load();
        } else {
            Dotenv::createMutable(base_path())->load();
        }
    }
    return new Application();
} catch (Exception $e) {
    exit($e->getMessage().PHP_EOL);
}
