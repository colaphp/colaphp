<?php

namespace App\Support;

class ComposerScripts
{
    public static function postAutoloadDump(): void
    {
        self::updateAbstractController();
    }

    public static function updateAbstractController(): void
    {
    }
}
