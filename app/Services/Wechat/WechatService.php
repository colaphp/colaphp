<?php

namespace App\Services\Wechat;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application;

class WechatService
{
    /**
     * 获取微信公众平台实例
     * @return Application
     * @throws InvalidArgumentException
     */
    public function instance(): Application
    {
        $config = config('wechat.official_account');

        return new Application($config);
    }
}
