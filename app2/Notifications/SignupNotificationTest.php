<?php

declare(strict_types=1);

namespace App\Notifications;

use Flame\Support\Facade\Notification;
use Tests\TestCase;

class SignupNotificationTest extends TestCase
{
    public function test_handle()
    {
        $notifiable = new \stdClass();
        $notifiable->email = 'wanganlin@xhchuxing.com';
        $message = 'email message content';
        Notification::send($notifiable, new SignupNotification($message));

        $this->assertTrue(true);
    }
}
