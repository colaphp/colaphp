<?php

declare(strict_types=1);

namespace App\API\Common\Controllers;

use Flame\Routing\Controller;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '公共接口', title: 'API文档', contact: new Contact('API Develop Team'))]
#[OA\Server(url: '/', description: '开发环境')]
abstract class BaseController extends Controller
{
    /**
     * 获取当前时间戳
     */
    protected function getTimestamp(): int
    {
        return now()->timestamp;
    }

    /**
     * 获取当前毫秒时间戳
     */
    protected function getMillisecond(): int
    {
        return $this->getTimestamp() * 1000;
    }
}
