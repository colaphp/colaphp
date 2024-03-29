<?php

declare(strict_types=1);

namespace App\Process;

use Workerman\Crontab\Crontab;

/**
 * Class Task
 */
class Task
{
    public function onWorkerStart()
    {
        // 每分钟的第一秒执行
        new Crontab('1 * * * * *', function () {
            echo date('Y-m-d H:i:s')."\n";
        });

        // 每天的7点50执行，注意这里省略了秒位.
        new Crontab('50 7 * * *', function () {
            echo date('Y-m-d H:i:s')."\n";
        });
    }
}
