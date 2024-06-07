<?php

declare(strict_types=1);

namespace Tests\Feature;

use Flame\Sms\SmsManager;
use Tests\TestCase;

class SmsTest extends TestCase
{
    public function test_send()
    {
        try {
            $sms = new SmsManager();
            $sms->send('15858589999', 'SMS_CODE', ['code' => 123456]);

            $this->assertTrue(true);
        } catch (\Throwable $e) {
            $this->fail($e->getMessage());
        }
    }
}
