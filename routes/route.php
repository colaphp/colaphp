<?php

declare(strict_types=1);

use Flame\Routing\Route;

$dirs = glob(base_path('frontend/*'), GLOB_ONLYDIR);
foreach ($dirs as $path) {
    $module = basename($path);
    Route::get('/'.$module, function () use ($module) {
        $template = public_path($module.'/index.html');
        if (file_exists($template)) {
            return response()->file($template);
        } else {
            return not_found();
        }
    });
}
