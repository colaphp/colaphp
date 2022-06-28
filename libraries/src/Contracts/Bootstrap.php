<?php

namespace Swift\Contracts;

use Workerman\Worker;

/**
 * Interface Bootstrap
 * @package Swift\Contracts
 */
interface Bootstrap
{
    /**
     * onWorkerStart
     *
     * @param Worker $worker
     * @return mixed
     */
    public static function start(Worker $worker);
}
