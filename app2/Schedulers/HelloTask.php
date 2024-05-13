<?php

declare(strict_types=1);

namespace App\Schedulers;

use Flame\Console\Contracts\ScheduleTaskInterface;
use Flame\Foundation\Attribute\ScheduledAttribute;

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
