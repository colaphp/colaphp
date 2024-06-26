<?php

// ==========================================================================
// Code generated by gen:route CLI tool. DO NOT EDIT.
// ==========================================================================

declare(strict_types=1);

use Flame\Routing\Route;

// Route start
Route::group('/api/v1/common', function () {
    // 获取图片验证码
    Route::get('/captcha', [\App\Bundles\Captcha\Controllers\Common\CaptchaController::class, 'index']);
    // 发送手机短信验证码
    Route::post('/sms/send', [\App\Bundles\Sms\Controllers\Common\SmsController::class, 'send']);
});
// end
