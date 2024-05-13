<?php

declare(strict_types=1);

use Flame\Support\Carbon;

require_once dirname(__DIR__).'/vendor/autoload.php';

defined('APP_START') or define('APP_START', microtime(true));

defined('ROOT_PATH') or define('ROOT_PATH', str_replace('\\', '/', dirname(__DIR__)));

(new Flame\Bootstrap\LoadEnvironmentVariables(ROOT_PATH))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'Asia/Shanghai'));

Carbon::setLocale('zh');
