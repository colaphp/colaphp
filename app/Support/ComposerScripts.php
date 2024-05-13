<?php

declare(strict_types=1);

namespace App\Support;

use Flame\Support\ComposerScripts as BaseComposerScripts;

class ComposerScripts extends BaseComposerScripts
{
    public static function postAutoloadDump(): void
    {
        parent::postAutoloadDump();
    }
}
