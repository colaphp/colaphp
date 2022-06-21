<?php

namespace App\Http\Controllers\Mobile;

use App\Services\Wechat\Message\MessageHandler;
use App\Services\Wechat\WechatService;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application;
use ReflectionException;

class WechatController extends BaseController
{
    /**
     * @var Application
     */
    private Application $wechat;

    /**
     * @return void
     * @throws InvalidArgumentException
     */
    protected function initialize()
    {
        $wechatService = new WechatService();
        $this->wechat = $wechatService->instance();
    }

    /**
     * @return string
     */
    public function index(): string
    {
        try {
            $server = $this->wechat->getServer();
            $server->with(MessageHandler::class);
            return $server->serve()->getBody()->getContents();
        } catch (InvalidArgumentException|ReflectionException|\Throwable $e) {
            Log::error($e->getMessage());
            return 'error';
        }
    }
}
