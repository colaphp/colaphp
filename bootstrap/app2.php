<?php

declare(strict_types=1);

use Flame\Support\Carbon;

defined('APP_START') or define('APP_START', microtime(true));

defined('ROOT_PATH') or define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)));

require_once ROOT_PATH.'/vendor/autoload.php';

(new Flame\Bootstrap\LoadEnvironmentVariables(ROOT_PATH))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'Asia/Shanghai'));

Carbon::setLocale('zh');

// Flame\Database\Eloquent::boot();
