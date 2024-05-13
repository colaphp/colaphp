<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\SendEmail;
use Exception;
use Flame\Support\Facade\Queue;
use Tests\TestCase;

class QueueTest extends TestCase
{
    public function test_send()
    {
        // 统计队列长度
        $c1 = Queue::instance('mail')->count();
        $this->assertTrue($c1 === 0);

        // 增加队列任务
        $sendEmail = new SendEmail(['test queue'.time()]);
        $rid = Queue::instance('mail')->push($sendEmail);
        $this->assertTrue($rid !== '');

        // 校验队列长度
        $c2 = Queue::instance('mail')->count();
        $this->assertTrue($c2 === $c1 + 1);

        // 消费队列
        $list = Queue::instance('mail')->pull(2);
        $this->assertNotEmpty($list);

        foreach ($list as $id => $job) {
            try {
                $job->handle();
                // 完成后在队列中删除
                Queue::instance('mail')->remove([$id]);
            } catch (Exception $e) {
                $this->fail('Queue consumption failure');
            }
        }

        // 统计队列长度
        $c3 = Queue::instance('mail')->count();
        $this->assertTrue($c3 === 0);
    }
}
