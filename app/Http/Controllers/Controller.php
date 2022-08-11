<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Cola\Http\Response;

/**
 * Class Controller
 */
abstract class Controller
{
    /**
     * 模板变量
     *
     * @var array
     */
    protected array $vars = [];

    /**
     * 变量赋值
     *
     * @param $name
     * @param $value
     */
    protected function assign($name, $value): void
    {
        $this->vars = array_merge($this->vars, [$name => $value]);
    }

    /**
     * 返回封装后的API数据到客户端
     *
     * @param  mixed  $data 要返回的数据
     * @param  array  $header 发送的Header信息
     * @return Response
     */
    protected function success(mixed $data, array $header = []): Response
    {
        return json([
            'code' => 0,
            'message' => 'ok',
            'data' => $data,
        ])->withHeaders($header);
    }

    /**
     * 返回异常数据到客户端
     *
     * @param  mixed  $message 错误信息
     * @param  int  $code 错误码
     * @param  array  $headers 发送的Header信息
     * @return Response
     */
    protected function error(mixed $message, int $code = 400, array $headers = []): Response
    {
        return json([
            'code' => $code,
            'message' => $message,
            'data' => null,
        ])->withHeaders($headers);
    }

    /**
     * 请求验证
     *
     * @param  array  $data
     * @param  array  $rules
     * @param  array  $messages
     * @param  array  $customAttributes
     * @return array
     *
     * @throws ValidationException
     * @throws Exception
     */
    protected function validate(array $data, array $rules, array $messages = [], array $customAttributes = []): array
    {
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->stopOnFirstFailure()->fails()) {
            throw new Exception($validator->errors()->first());
        }

        return $validator->validated();
    }

    /**
     * 返回用户数据的属性
     *
     * @param $token
     * @return array
     *
     * @throws Exception
     */
    protected function auth($token = null): array
    {
        if (is_null($token)) {
            $token = $this->request->header('X-Token', '');
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
