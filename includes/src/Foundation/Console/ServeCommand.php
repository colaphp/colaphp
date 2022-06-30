<?php

namespace Swift\Foundation\Console;

use Dotenv\Dotenv;
use ErrorException;
use Swift\Config\Config;
use Swift\Container\Container;
use Swift\Foundation\App;
use Swift\Http\Middleware\Middleware;
use Swift\Http\Request;
use Swift\Log\Log;
use Swift\Routing\Route;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http;
use Workerman\Worker;

/**
 * Class ServeCommand
 * @package Swift\Foundation\Console
 */
class ServeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected static $defaultName = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected function configure()
    {
        $this->setDescription('Serve the application')
            ->addArgument('action', InputArgument::OPTIONAL, 'php artisan serve {start|reload|stop}', 'start')
            ->addOption('daemon', 'd', null, 'Start in DAEMON mode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        global $argv;
        $argv[1] = $input->getArgument('action');
        $argv[2] = $input->getOption('daemon') ? '-d' : '';

        if (class_exists('Dotenv\Dotenv')) {
            if (method_exists('Dotenv\Dotenv', 'createUnsafeImmutable')) {
                Dotenv::createUnsafeImmutable(base_path())->load();
            } else {
                Dotenv::createMutable(base_path())->load();
            }
        }

        Config::load(config_path());

        if ($timezone = config('app.default_timezone')) {
            date_default_timezone_set($timezone);
        }

        $runtime_logs_path = runtime_path('logs');
        if (!file_exists($runtime_logs_path) || !is_dir($runtime_logs_path)) {
            if (!mkdir($runtime_logs_path, 0777, true)) {
                throw new \RuntimeException("Failed to create runtime logs directory. Please check the permission.");
            }
        }

        $runtime_sessions_path = runtime_path('sessions');
        if (!file_exists($runtime_sessions_path) || !is_dir($runtime_sessions_path)) {
            if (!mkdir($runtime_sessions_path, 0777, true)) {
                throw new \RuntimeException("Failed to create runtime sessions directory. Please check the permission.");
            }
        }

        $runtime_views_path = runtime_path('views');
        if (!file_exists($runtime_views_path) || !is_dir($runtime_views_path)) {
            if (!mkdir($runtime_views_path, 0777, true)) {
                throw new \RuntimeException("Failed to create runtime views directory. Please check the permission.");
            }
        }

        Worker::$onMasterReload = function () {
            if (function_exists('opcache_get_status')) {
                if ($status = opcache_get_status()) {
                    if (isset($status['scripts']) && $scripts = $status['scripts']) {
                        foreach (array_keys($status['scripts']) as $file) {
                            opcache_invalidate($file, true);
                        }
                    }
                }
            }
        };

        $config = config('server');
        Worker::$pidFile = $config['pid_file'];
        Worker::$stdoutFile = $config['stdout_file'];
        Worker::$logFile = $config['log_file'];
        Worker::$eventLoopClass = $config['event_loop'] ?? '';
        TcpConnection::$defaultMaxPackageSize = $config['max_package_size'] ?? 10 * 1024 * 1024;
        if (property_exists(Worker::class, 'statusFile')) {
            Worker::$statusFile = $config['status_file'] ?? '';
        }

        if ($config['listen']) {
            $worker = new Worker($config['listen'], $config['context']);
            $property_map = [
                'name',
                'count',
                'user',
                'group',
                'reusePort',
                'transport',
            ];
            foreach ($property_map as $property) {
                if (isset($config[$property])) {
                    $worker->$property = $config[$property];
                }
            }

            $worker->onWorkerStart = function ($worker) {
                require_once dirname(__DIR__, 2) . '/Support/bootstrap.php';
                $app = new App($worker, Container::instance(), Log::channel('default'), app_path(), public_path());
                Http::requestClass(config('app.request_class', Request::class));
                $worker->onMessage = [$app, 'onMessage'];
            };
        };

        // Windows does not support custom processes.
        if (DIRECTORY_SEPARATOR === '/') {
            foreach (config('process', []) as $process_name => $config) {
                worker_start($process_name, $config);
            }
        }

        Worker::runAll();
    }
}