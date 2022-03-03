<?php

use Swift\Routing\Route;
use Swift\Support\Str;

Route::get('/admin', function () {
    $token = Str::random();
    session(['admin_token' => $token]);
    return redirect('/console?token=' . $token);
});
