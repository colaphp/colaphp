<?php

declare(strict_types=1);

use Flame\Bootstrap\LoadEnvironmentVariables;
use Flame\Support\Carbon;

(new LoadEnvironmentVariables(dirname(__DIR__)))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'Asia/Shanghai'));

Carbon::setLocale('zh');
