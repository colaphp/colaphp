<?php

declare(strict_types=1);

namespace Tests\Feature;

use Flame\Mail\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    public function test_send()
    {
        try {
            $mail = new Mail();
            $mail->sendByTemplate('wanganlin@xhchuxing.com', 'mail template test', 'signup', [
                'aa' => 'aaaaa',
                'bb' => 'bbbbb',
                'cc' => 'ccccc',
                'time' => microtime(true),
            ]);

            $this->assertTrue(true);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }
    }
}
