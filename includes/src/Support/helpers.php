<?php

use Swift\Config\Config;
use Swift\Container\Container;
use Swift\Foundation\App;
use Swift\Http\Request;
use Swift\Http\Response;
use Swift\Routing\Route;
use Swift\Translation\Translation;
use Workerman\Worker;

define('FRAMEWORK_VERSION', '1.0.14.220323');
define('BASE_PATH', realpath(dirname(__DIR__, 3)));

/**
 * @param string $path
 * @return string
 */
function base_path(string $path = ''): string
{
    return BASE_PATH . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function app_path(string $path = ''): string
{
    return base_path('app') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function config_path(string $path = ''): string
{
    return base_path('config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function database_path(string $path = ''): string
{
    return base_path('database') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function public_path(string $path = ''): string
{
    return base_path('public') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function resource_path(string $path = ''): string
{
    return base_path('resources') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $path
 * @return string
 */
function runtime_path(string $path = ''): string
{
    return base_path('runtime') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

/**
 * @param string $body
 * @param int $status
 * @param array $headers
 * @return Response
 */
function response(string $body = '', int $status = 200, array $headers = []): Response
{
    return new Response($status, $headers, $body);
}

/**
 * @param $data
 * @param int $options
 * @return Response
 */
function json($data, int $options = JSON_UNESCAPED_UNICODE): Response
{
    return new Response(200, ['Content-Type' => 'application/json'], json_encode($data, $options));
}

/**
 * @param $xml
 * @return Response
 */
function xml($xml): Response
{
    if ($xml instanceof SimpleXMLElement) {
        $xml = $xml->asXML();
    }
    return new Response(200, ['Content-Type' => 'text/xml'], $xml);
}

/**
 * @param $data
 * @param string $callback_name
 * @return Response
 */
function jsonp($data, string $callback_name = 'callback'): Response
{
    if (!is_scalar($data) && null !== $data) {
        $data = json_encode($data);
    }
    return new Response(200, [], "$callback_name($data)");
}

/**
 * @param $location
 * @param int $status
 * @param array $headers
 * @return Response
 */
function redirect($location, int $status = 302, array $headers = []): Response
{
    $response = new Response($status, ['Location' => $location]);
    if (!empty($headers)) {
        $response->withHeaders($headers);
    }
    return $response;
}

/**
 * @param $template
 * @param array $vars
 * @param null $app
 * @return Response
 */
function view($template, array $vars = [], $app = null): Response
{
    static $handler;
    if (null === $handler) {
        $handler = config('view.handler');
    }
    return new Response(200, [], $handler::render($template, $vars, $app));
}

/**
 * @return Request
 */
function request(): Request
{
    return App::request();
}

/**
 * @param $key
 * @param null $default
 * @return mixed
 */
function config($key = null, $default = null)
{
    return Config::get($key, $default);
}

/**
 * @param $name
 * @param array $parameters
 * @return string
 */
function route($name, array $parameters = [])
{
    $route = Route::getByName($name);
    if (!$route) {
        return '';
    }
    return $route->url($parameters);
}

/**
 * @param null $key
 * @param null $default
 * @return mixed
 */
function session($key = null, $default = null)
{
    $session = request()->session();
    if (null === $key) {
        return $session;
    }
    if (is_array($key)) {
        $session->put($key);
        return null;
    }
    return $session->get($key, $default);
}

/**
 * @param null|string $id
 * @param array $parameters
 * @param string|null $domain
 * @param string|null $locale
 * @return string
 */
function trans(string $id, array $parameters = [], string $domain = null, string $locale = null)
{
    $res = Translation::trans($id, $parameters, $domain, $locale);
    return $res === '' ? $id : $res;
}

/**
 * @param null|string $locale
 * @return string
 */
function locale(string $locale = null)
{
    if (!$locale) {
        return Translation::getLocale();
    }
    Translation::setLocale($locale);
}

/**
 * 404 not found
 * @return Response
 */
function not_found()
{
    return new Response(404, [], file_get_contents(public_path() . '/404.html'));
}

/**
 * 复制目录
 * @param $source
 * @param $dest
 * @return void
 */
function copy_dir($source, $dest, $overwrite = false)
{
    if (is_dir($source)) {
        if (!is_dir($dest)) {
            mkdir($dest);
        }
        $files = scandir($source);
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                copy_dir("$source/$file", "$dest/$file");
            }
        }
    } else if (file_exists($source) && ($overwrite || !file_exists($dest))) {
        copy($source, $dest);
    }
}

/**
 * 删除目录
 * @param $dir
 * @return bool
 */
function remove_dir($dir)
{
    if (is_link($dir) || is_file($dir)) {
        return unlink($dir);
    }
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
        (is_dir("$dir/$file") && !is_link($dir)) ? remove_dir("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
}

/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name 字符串
 * @param int $type 转换类型
 * @param bool $ucfirst 首字母是否大写（驼峰规则）
 * @return string
 */
function parse_name(string $name, int $type = 0, bool $ucfirst = true): string
{
    if ($type) {
        $name = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        }, $name);

        return $ucfirst ? ucfirst($name) : lcfirst($name);
    }

    return strtolower(trim(preg_replace('/[A-Z]/', '_\\0', $name), '_'));
}

/**
 * @param $worker
 * @param $class
 */
function worker_bind($worker, $class)
{
    $callback_map = [
        'onConnect',
        'onMessage',
        'onClose',
        'onError',
        'onBufferFull',
        'onBufferDrain',
        'onWorkerStop',
        'onWebSocketConnect'
    ];
    foreach ($callback_map as $name) {
        if (method_exists($class, $name)) {
            $worker->$name = [$class, $name];
        }
    }
    if (method_exists($class, 'onWorkerStart')) {
        call_user_func([$class, 'onWorkerStart'], $worker);
    }
}

/**
 * @param $process_name
 * @param $config
 * @return void
 */
function worker_start($process_name, $config) {
    $worker = new Worker($config['listen'] ?? null, $config['context'] ?? []);
    $property_map = [
        'count',
        'user',
        'group',
        'reloadable',
        'reusePort',
        'transport',
        'protocol',
    ];
    $worker->name = $process_name;
    foreach ($property_map as $property) {
        if (isset($config[$property])) {
            $worker->$property = $config[$property];
        }
    }

    $worker->onWorkerStart = function ($worker) use ($config) {
        require_once __DIR__ . '/bootstrap.php';

        foreach ($config['services'] ?? [] as $server) {
            if (!class_exists($server['handler'])) {
                echo "process error: class {$server['handler']} not exists\r\n";
                continue;
            }
            $listen = new Worker($server['listen'] ?? null, $server['context'] ?? []);
            if (isset($server['listen'])) {
                echo "listen: {$server['listen']}\n";
            }
            $instance = Container::make($server['handler'], $server['constructor'] ?? []);
            worker_bind($listen, $instance);
            $listen->listen();
        }

        if (isset($config['handler'])) {
            if (!class_exists($config['handler'])) {
                echo "process error: class {$config['handler']} not exists\r\n";
                return;
            }

            $instance = Container::make($config['handler'], $config['constructor'] ?? []);
            worker_bind($worker, $instance);
        }

    };
}

/**
 * @return int
 */
function cpu_count()
{
    if (DIRECTORY_SEPARATOR === '\\') {
        return 1;
    }
    if (strtolower(PHP_OS) === 'darwin') {
        $count = shell_exec('sysctl -n machdep.cpu.core_count');
    } else {
        $count = shell_exec('nproc');
    }
    return (int)$count > 0 ? (int)$count : 4;
}
