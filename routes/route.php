<?php

declare(strict_types=1);

use Flame\Http\Request;
use Flame\Routing\Route;

Route::group('api', function () {
    Route::get('test', function (Request $request) {
        return response('test');
    });
});
