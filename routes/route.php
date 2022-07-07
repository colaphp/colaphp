<?php

declare(strict_types=1);

use Cola\Routing\Route;

Route::get('/admin', function () {
    $hash = md5((string)microtime(true));
    session(['__request_hash' => $hash]);
    return redirect('/console?hash=' . $hash);
});
