<?php

declare(strict_types=1);

namespace App\Managers\DingTalk;

use Exception;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\HttpClient;

class BaseManager
{
    const ACCESS_TOKEN = 'DT_ACCESS_TOKEN';

    const USER_ACCESS_TOKEN = 'DT_USER_ACCESS_TOKEN';

    /**
     * 配置信息
     */
    protected array $config = [
        'corp_id' => '',
        'app_key' => '',
        'app_secret' => '',
        'agent_id' => '',
    ];

    public function __construct()
    {
        $this->config = array_merge($this->config, config('dingtalk'));
    }

    /**
     * 获取钉钉配置
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * 获取企业内部应用的accessToken
     *
     * @see https://open.dingtalk.com/document/orgapp/obtain-the-access_token-of-an-internal-app
     *
     * @throws CustomException
     */
    public function getAccessToken(): string
    {
        try {
            $requestBody = [
                'appKey' => $this->config['app_key'],
                'appSecret' => $this->config['app_secret'],
            ];

            $cacheName = self::ACCESS_TOKEN.$this->config['app_key'];
            $accessToken = cache($cacheName);

            if (empty($accessToken)) {
                $response = HttpClient::postJsonUrl('https://api.dingtalk.com/v1.0/oauth2/accessToken', $requestBody);
                $decode = json_decode($response, true);
                $accessToken = $decode['accessToken'];
                cache($cacheName, $accessToken, $decode['expireIn'] - 60);
            }

            return $accessToken;
        } catch (Exception $e) {
            throw new CustomException(sprintf('获取钉钉AccessToken失败：%s', $e->getMessage()));
        }
    }

    /**
     * 发送Http POST请求
     *
     * @throws CustomException
     */
    public function postRequest(string $url, $requestBody): array
    {
        try {
            $response = HttpClient::postJsonUrl($url.'?access_token='.$this->getAccessToken(), $requestBody);

            $decode = json_decode($response, true);
            if ($decode['errcode'] === 0) {
                return $decode['result'];
            }

            throw new CustomException($decode['errmsg']);
        } catch (Exception $e) {
            throw new CustomException(sprintf('请求钉钉失败：%s', $e->getMessage()));
        }
    }
}
