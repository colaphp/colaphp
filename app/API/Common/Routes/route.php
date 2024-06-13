<?php

declare(strict_types=1);

use Flame\Routing\Route;

Route::group('/api/v1/common', function () {
    Route::get('/captcha', [\App\Bundles\Captcha\Controllers\Common\ImageController::class, 'index']);
});
