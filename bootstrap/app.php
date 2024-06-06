<?php

declare(strict_types=1);

use Flame\Container\Container;

try {
    $builder = new Container();
    $builder->useAutowiring(true);
    $builder->useAttributes(true);
    return $builder->build();
} catch (Throwable $e) {
    exit($e->getMessage().PHP_EOL);
}
