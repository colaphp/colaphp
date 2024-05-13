<?php

declare(strict_types=1);

namespace App\Notifications;

use Flame\Notifications\Messages\Message;
use Flame\Notifications\Notification;

/**
 * exp:
 *   $notifiable = new stdClass();
 *   $notifiable->email = 'name@domain.com';
 *   $message = 'email message content';
 *   Notification::send($notifiable, new SignupNotification($message));
 */
class SignupNotification extends Notification
{
    private string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    /**
     * 获取通知发送频道。
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): Message
    {
        $message = new Message($this->body);
        $message->setTo($notifiable->email);
        $message->setTitle('注册邮件测试');

        return $message;
    }
}
