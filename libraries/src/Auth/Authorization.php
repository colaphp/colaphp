<?php

namespace Swift\Auth;

/**
 * Class Authorization
 * @package Swift\Auth
 */
class Authorization
{
    /**
     * jwt
     * @var JWT
     */
    public JWT $jwt;

    /**
     * Authorization constructor.
     * @param JWT $jwt
     */
    public function __construct(JWT $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * 获取有效荷载
     * @param TokenExtractorInterface $tokenExtractor
     * @return array
     */
    public function getPayload(TokenExtractorInterface $tokenExtractor): array
    {
        $token = $tokenExtractor->extractToken();
        return $this->jwt->parse($token);
    }

    /**
     * 根据token获取有效荷载
     * @param string $token
     * @return array
     */
    public function getPayloadByToken(string $token): array
    {
        return $this->jwt->parse($token);
    }

    /**
     * 创建token
     * @param array $payload
     * @return string
     */
    public function createToken(array $payload): string
    {
        return $this->jwt->create($payload);
    }
}
