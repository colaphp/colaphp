<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('hello')
            ->setDescription('The hello test.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo 'hello world'.PHP_EOL;

        return 0;
    }
}
