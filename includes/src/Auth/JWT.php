<?php

namespace Swift\Auth;

use Firebase\JWT\Key;

/**
 * Class JWT
 * @package Swift\Auth
 */
class JWT
{
    /**
     * 签名算法常量
     */
    const ALGORITHM_HS256 = 'HS256';
    const ALGORITHM_HS384 = 'HS384';
    const ALGORITHM_HS512 = 'HS512';
    const ALGORITHM_RS256 = 'RS256';
    const ALGORITHM_RS384 = 'RS384';
    const ALGORITHM_RS512 = 'RS512';

    /**
     * 钥匙
     * @var string
     */
    public string $key = '';

    /**
     * 私钥
     * @var string
     */
    public string $privateKey = '';

    /**
     * 公钥
     * @var string
     */
    public string $publicKey = '';

    /**
     * 签名算法
     * @var string
     */
    public string $algorithm = self::ALGORITHM_HS256;

    /**
     * JWT constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        if (isset($config['algorithm'])) {
            $this->algorithm = $config['algorithm'];
        }
        if (isset($config['key'])) {
            $this->key = $config['key'];
        }
        if (isset($config['privateKey'])) {
            $this->privateKey = $config['privateKey'];
        }
        if (isset($config['publicKey'])) {
            $this->publicKey = $config['publicKey'];
        }
    }

    /**
     * 解析Token
     * @param string $token
     * @return array
     */
    public function parse(string $token): array
    {
        return match ($this->algorithm) {
            self::ALGORITHM_HS256, self::ALGORITHM_HS384, self::ALGORITHM_HS512 => (array)\Firebase\JWT\JWT::decode($token, new Key($this->key, $this->algorithm)),
            self::ALGORITHM_RS256, self::ALGORITHM_RS384, self::ALGORITHM_RS512 => (array)\Firebase\JWT\JWT::decode($token, new Key($this->publicKey, $this->algorithm)),
            default => throw new \InvalidArgumentException('Invalid signature algorithm.'),
        };
    }

    /**
     * 创建Token
     * @param array $payload
     * @return string
     */
    public function create(array $payload): string
    {
        return match ($this->algorithm) {
            self::ALGORITHM_HS256, self::ALGORITHM_HS384, self::ALGORITHM_HS512 => \Firebase\JWT\JWT::encode($payload, $this->key, $this->algorithm),
            self::ALGORITHM_RS256, self::ALGORITHM_RS384, self::ALGORITHM_RS512 => \Firebase\JWT\JWT::encode($payload, $this->privateKey, $this->algorithm),
            default => throw new \InvalidArgumentException('Invalid signature algorithm.'),
        };
    }
}
