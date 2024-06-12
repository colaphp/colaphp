<?php

declare(strict_types=1);

namespace App\Support;

use App\Enums\AuthTypeEnum;
use Carbon\Carbon;
use Flame\Auth\Authentication;
use Flame\Auth\BearerTokenExtractor;
use Flame\Foundation\Exception\CustomException;

class JWTHelper
{
    /**
     * 返回用户数据
     *
     * @throws CustomException
     */
    public function auth(AuthTypeEnum $authTypeEnum, $token = null): array
    {
        $payload = $this->getPayloadByToken($token);

        $authType = $authTypeEnum->value;
        $authTypeId = $authType.'Id';
        if (isset($payload[$authTypeId])) {
            $serviceName = '\\App\\Services\\'.$authType.'Service';
            if (! class_exists($serviceName)) {
                throw new CustomException('认证服务类型不存在');
            }

            $service = new $serviceName();

            return $service->getById($payload[$authTypeId]);
        }

        return [];
    }

    /**
     * 创建JWT参数
     */
    public function createToken(array $body, int $expire = 0): string
    {
        $authentication = new Authentication();

        $payload = config('jwt.payload');
        $payload = array_merge($body, $payload);
        if ($expire > 0) {
            $payload['exp'] = Carbon::now()->timestamp + $expire;
        }

        return $authentication->createToken($payload);
    }

    /**
     * 根据Token头获取JWT参数
     */
    public function getPayloadByBearer(): array
    {
        $authentication = new Authentication();

        $bearerTokenExtractor = new BearerTokenExtractor();

        return $authentication->getPayload($bearerTokenExtractor);
    }

    /**
     * 根据Token头获取JWT参数
     */
    public function getPayloadByToken(string $token): array
    {
        $authentication = new Authentication();

        return $authentication->getPayloadByToken($token);
    }
}
