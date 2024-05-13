<?php

declare(strict_types=1);

namespace App\Support;

class ComposerScripts extends \Flame\Support\ComposerScripts
{
    public static function postAutoloadDump(): void
    {
        parent::postAutoloadDump();
    }
}
