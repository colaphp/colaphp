<?php

use Dotenv\Dotenv;
use Swift\Config\Config;
use Swift\Container\Container;
use Swift\Http\Middleware\Middleware;
use Swift\Routing\Route;

$worker = $worker ?? null;

if ($timezone = config('app.default_timezone')) {
    date_default_timezone_set($timezone);
}

set_error_handler(function ($level, $message, $file = '', $line = 0, $context = []) {
    if (error_reporting() & $level) {
        throw new ErrorException($message, 0, $level, $file, $line);
    }
});

if ($worker) {
    register_shutdown_function(function ($start_time) {
        if (time() - $start_time <= 1) {
            sleep(1);
        }
    }, time());
}

if (class_exists('Dotenv\Dotenv') && file_exists(base_path() . '/.env')) {
    if (method_exists('Dotenv\Dotenv', 'createUnsafeImmutable')) {
        Dotenv::createUnsafeImmutable(base_path())->load();
    } else {
        Dotenv::createMutable(base_path())->load();
    }
}

Config::reload(config_path());

foreach (config('autoload.files', []) as $file) {
    include_once $file;
}

$container = Container::instance();
Route::container($container);
Middleware::container($container);

if (class_exists('App\Http\Kernel')) {
    Middleware::load(['' => \App\Http\Kernel::$middleware]);
    Middleware::load(\App\Http\Kernel::$middlewareGroups);
}
Middleware::load(['__static__' => config('static.middleware', [])]);

foreach (config('app.providers', []) as $class_name) {
    /** @var \Swift\Contracts\Bootstrap $class_name */
    $class_name::start($worker);
}

Route::load(base_path('routes'));
