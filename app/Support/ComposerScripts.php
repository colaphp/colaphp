<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Class ComposerScripts
 */
class ComposerScripts
{
    public static function postAutoloadDump(): void
    {
        self::updateAbstractController();
    }

    public static function updateAbstractController(): void
    {
        $basePath = dirname(__DIR__, 2);
        self::addMigrationPrefix($basePath);
    }

    public static function addMigrationPrefix($basePath): void
    {
        $commands = glob($basePath.'/vendor/robmorgan/phinx/src/Phinx/Console/Command/*.php');
        foreach ($commands as $command) {
            $content = file_get_contents($command);
            $result = preg_match('/protected static \$defaultName = \'(\w+)\';/', $content, $matches);
            if ($result !== false && isset($matches[1])) {
                $content = str_replace('defaultName = \'', 'defaultName = \'migration:', $content);
                file_put_contents($command, $content);
            }
        }
    }
}
