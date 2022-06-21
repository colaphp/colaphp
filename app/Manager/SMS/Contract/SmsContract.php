<?php

namespace App\Managers\SMS\Contract;

interface SmsContract
{
    /**
     * 短信发送
     * @param $mobile
     * @param $content
     * @return bool
     */
    public function send($mobile, $content): bool;

    /**
     * 查询账户余额
     * @return array
     */
    public function balance(): array;

    /**
     * 查询发送历史
     * @return array
     */
    public function history(): array;
}
