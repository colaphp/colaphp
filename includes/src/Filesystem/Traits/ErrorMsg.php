<?php

namespace Swift\Filesystem\Traits;

trait ErrorMsg
{
    /**
     * 错误消息
     */
    public array $error = [
        'message' => '错误消息',
        'data' => [],
    ];

    /**
     * 设置错误
     * @param bool $success 是否成功
     * @param string $message 错误消息
     * @param array $data 消息体
     */
    public function setError(bool $success, string $message, array $data = []): bool
    {
        $this->error = [
            'message' => $message,
            'data' => $data,
        ];

        return $success;
    }

    /**
     * 获取错误信息
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getMessage(): string
    {
        return $this->error['message'];
    }

    /**
     * @param bool $success
     * @param string $message
     * @param int $code
     * @param array $data
     * @return array
     */
    public function returnData(bool $success, string $message = '', int $code = 0, array $data = []): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ];
    }
}
