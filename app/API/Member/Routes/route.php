<?php

// ==========================================================================
// Code generated by gen:route CLI tool. DO NOT EDIT.
// ==========================================================================

declare(strict_types=1);

use Flame\Routing\Route;

// Route start
Route::group('/api/v1/member', function () {
    // 通过短信验证码登录
    Route::post('/sms/login', [\App\Bundles\Auth\Controllers\Member\SmsController::class, 'login']);
    // 微信小程序登录
    Route::post('/wechat/login', [\App\Bundles\Auth\Controllers\Member\WechatController::class, 'login']);
});
// end