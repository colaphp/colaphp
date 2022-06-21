<?php

namespace App\Services\Wechat\Message;

use Closure;

class MessageHandler
{
    public function __invoke($message, Closure $next)
    {
        if ($message->MsgType === 'text') {
            //...
        }

        return $next($message);
    }
}
