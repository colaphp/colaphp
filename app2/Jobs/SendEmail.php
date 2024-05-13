<?php

declare(strict_types=1);

namespace App\Jobs;

use Flame\Queue\Contracts\JobInterface;

class SendEmail implements JobInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        file_put_contents(runtime_path('queue.txt'), var_export($this->data, true));
    }
}
