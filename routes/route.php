<?php

use Swift\Routing\Route;

$dir_iterator = new RecursiveDirectoryIterator(app_path());
$iterator = new RecursiveIteratorIterator($dir_iterator);
foreach ($iterator as $file) {
    if (is_dir($file) || $file->getExtension() != 'php') {
        continue;
    }

    $file_path = str_replace('\\', '/', $file->getPathname());
    if (strpos($file_path, 'Controllers') === false) {
        continue;
    }

    $uri_path = strtolower(str_replace('Http/Controllers/', '', substr(substr($file_path, strlen(app_path())), 0, -14)));
    $class_name = str_replace('/', '\\', substr(substr($file_path, strlen(base_path())), 0, -4));
    $class_name = str_replace('\app\\', '\App\\', $class_name);

    if (!class_exists($class_name)) {
        echo "Class $class_name not found, skip route for it\n";
        continue;
    }

    $class = new ReflectionClass($class_name);
    $class_name = $class->name;
    $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);

    $route = function ($uri, $cb) {
        // echo "Route $uri [{$cb[0]}, {$cb[1]}]\n";
        Route::any($uri, $cb);
        Route::any($uri.'/', $cb);
    };

    foreach ($methods as $item) {
        $action = $item->name;
        if (in_array($action, ['__construct', '__destruct'])) {
            continue;
        }
        if ($action === 'index') {
            if (substr($uri_path, -6) === '/index') {
                $route(substr($uri_path, 0, -6), [$class_name, $action]);
            }
            $route($uri_path, [$class_name, $action]);
        }
        $route($uri_path.'/'.$action, [$class_name, $action]);
    }
}
