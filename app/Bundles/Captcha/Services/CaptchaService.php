<?php

declare(strict_types=1);

namespace App\Bundles\Captcha\Services;

use Flame\Captcha\Captcha;

class CaptchaService extends Captcha
{
    const SESSION_KEY = 'CAPTCHA';
}
