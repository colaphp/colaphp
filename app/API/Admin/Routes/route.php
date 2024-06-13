<?php

declare(strict_types=1);

use Flame\Routing\Route;

Route::group('/api/v1/admin', function () {
    Route::get('/article', [\App\Bundles\Article\Controllers\Admin\ArticleController::class, 'index']);
});
