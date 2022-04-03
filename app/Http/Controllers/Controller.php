<?php

namespace App\Http\Controllers;

use App\Services\Auth\PassportService;
use App\Services\User\UserService;
use Exception;
use Swift\Http\Response;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
abstract class Controller
{
    /**
     * @var int
     */
    protected int $errorCode = 1;

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
     * @param int $errorCode
     * @return Response
     */
    protected function failed($message, int $errorCode = 1): Response
    {
        if ($errorCode > 0) {
            $this->setErrorCode($errorCode);
        }

        return json([
            'error' => $this->getErrorCode(),
            'message' => $message,
        ]);
    }

    /**
     * 返回用户数据的属性
     * @param $token
     * @return array
     * @throws Exception
     */
    protected function auth($token = null): array
    {
        if (is_null($token)) {
            $token = request()->cookie(USER_TOKEN, '');
        }

        $passportService = new PassportService();
        $payload = $passportService->getPayloadByToken($token);

        if (isset($payload['uid'])) {
            $userService = new UserService();
            $userOutput = $userService->findOne($payload['uid']);
            return $userOutput->toArray();
        }

        return [];
    }

}
