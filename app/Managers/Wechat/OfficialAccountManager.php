<?php

declare(strict_types=1);

namespace App\Managers\Wechat;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application;

class OfficialAccountManager extends BaseManager
{
    private ?Application $app;

    /**
     * 设置公众号配置
     *
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $config = config('wechat.official_account');

        $this->app = new Application($config);
        $this->app->setCache(new CustomCache());
    }

    public function getApp(): Application
    {
        return $this->app;
    }
}
