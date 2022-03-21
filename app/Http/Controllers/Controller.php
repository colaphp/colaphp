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

}
