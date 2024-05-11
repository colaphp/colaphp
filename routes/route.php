<?php

declare(strict_types=1);

use App\Http\Controllers\Web\IndexController;
use Flame\Routing\Route;

Route::get('/admin', function () {
    $hash = md5((string) microtime(true));
    session(['__request_hash' => $hash]);

    return redirect('/console?hash='.$hash);
});

Route::get('/json2', [IndexController::class, 'json']);
