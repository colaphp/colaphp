<?php

namespace App\Services\Auth;

use Exception;

class SocializeService
{
    /**
     * @var array
     */
    private array $supportType = [
        'wechat',
    ];

    /**
     * 在线授权
     * @param string $type 授权类型
     * @return string
     * @throws Exception
     */
    public function authorize(string $type): string
    {
        if (!in_array($type, $this->supportType)) {
            throw new Exception('Unsupported OAuth type ' . $type);
        }

        return '';
    }
}
