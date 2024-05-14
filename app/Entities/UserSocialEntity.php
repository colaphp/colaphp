<?php

declare(strict_types=1);

namespace App\Entities;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserSocialEntity')]
class UserSocialEntity
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'user_id', description: '用户ID', type: 'integer')]
    private int $user_id;

    #[OA\Property(property: 'provider', description: '认证类型:username,email,mobile,wechat', type: 'string')]
    private string $provider;

    #[OA\Property(property: 'provider_user_id', description: '通行证:手机号/邮箱/用户名或第三方应用的唯一标识', type: 'string')]
    private string $provider_user_id;

    #[OA\Property(property: 'access_token', description: '访问令牌', type: 'string')]
    private string $access_token;

    #[OA\Property(property: 'refresh_token', description: '刷新令牌', type: 'string')]
    private string $refresh_token;

    #[OA\Property(property: 'expires_in', description: '访问令牌过期时间（秒）', type: 'integer')]
    private int $expires_in;

    #[OA\Property(property: 'token_created_at', description: '访问令牌创建时间', type: 'string')]
    private string $token_created_at;

    #[OA\Property(property: 'created_at', description: '创建时间', type: 'string')]
    private string $created_at;

    #[OA\Property(property: 'updated_at', description: '更新时间', type: 'string')]
    private string $updated_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): void
    {
        $this->provider = $provider;
    }

    public function getProviderUserId(): string
    {
        return $this->provider_user_id;
    }

    public function setProviderUserId(string $provider_user_id): void
    {
        $this->provider_user_id = $provider_user_id;
    }

    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }

    public function setRefreshToken(string $refresh_token): void
    {
        $this->refresh_token = $refresh_token;
    }

    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }

    public function setExpiresIn(int $expires_in): void
    {
        $this->expires_in = $expires_in;
    }

    public function getTokenCreatedAt(): string
    {
        return $this->token_created_at;
    }

    public function setTokenCreatedAt(string $token_created_at): void
    {
        $this->token_created_at = $token_created_at;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
