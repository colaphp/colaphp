<?php

namespace App\Http\Controllers;

use Exception;
use Firebase\JWT\JWT;
use Swift\Http\Response;
use Swift\Support\Carbon;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller
{
    /**
     * @var int
     */
    protected int $errorCode = 0;

    /**
     * @return int
     */
    protected function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param $errorCode
     * @return $this
     */
    protected function setErrorCode($errorCode): static
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * 返回封装后的API数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param array $header 发送的Header信息
     * @return Response
     */
    protected function succeed($data, array $header = []): Response
    {
        return json([
            'error' => 0,
            'data' => $data,
        ])->withHeaders($header);
    }

    /**
     * 返回异常数据到客户端
     * @param $message
     * @return Response
     */
    protected function failed($message): Response
    {
        return json([
            'error' => 1,
            'errors' => [
                'code' => $this->getErrorCode(),
                'message' => $message,
            ],
        ]);
    }

    /**
     * 返回用户数据的属性
     * @param null $token
     * @param string $header
     * @return string
     */
    public function auth($token = null, string $header = 'X-Token'): string
    {
        if (is_null($token)) {
            $token = request()->header($header);
        }

        return $this->JWTDecode($token);
    }

    /**
     * 通过JWT加密用户数据
     * @param null $payload
     * @return string
     */
    public function JWTEncode($payload = null): string
    {
        $key = config('jwt.key');

        $payload = $this->getPayload($payload);

        return JWT::encode($payload, $key);
    }

    /**
     * 通过JWT解密用户数据
     * @param $token
     * @param string $item
     * @return mixed
     */
    public function JWTDecode($token, string $item = 'body')
    {
        if (is_null($token)) {
            return null;
        }

        $key = config('jwt.key');

        try {
            $data = JWT::decode($token, $key, ['HS256']);

            return collect($data)->get($item);
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * 设置JWT数据的有效期
     * @param null $data
     * @return array
     */
    protected function getPayload($data = null): array
    {
        $jwt = config('jwt');

        $payload = $jwt['payload'];

        $payload['exp'] = Carbon::now()->addDays($jwt['expires'])->timestamp; // Add Token expires 过期时间

        return array_merge($payload, ['body' => $data]);
    }
}
