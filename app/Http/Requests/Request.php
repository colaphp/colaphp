<?php

namespace App\Http\Requests;

use Exception;
use Swift\Http\Request as BaseRequest;

/**
 * Class Request
 * @package App\Http\Requests
 */
class Request extends BaseRequest
{
    /**
     * 获取店铺ID
     * @return int
     * @throws Exception
     */
    public function shopId(): int
    {
        $shopId = $this->header('ShopId', 0);
        if (empty($shopId)) {
            throw new Exception('店铺参数异常');
        }
        return $shopId;
    }
}
