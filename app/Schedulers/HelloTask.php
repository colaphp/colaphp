<?php

declare(strict_types=1);

namespace App\Schedulers;

use Flame\Console\Contracts\ScheduleTaskInterface;

class HelloTask implements ScheduleTaskInterface
{
    public function cron(): ?string
    {
        return '0 0 28 * *';
    }

    public function handle(): void
    {

    }
}
