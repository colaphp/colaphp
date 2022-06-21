<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 模板变量
     * @var array
     */
    protected array $vars = [];

    /**
     * 请求验证
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array
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
     * 返回封装后的API数据到客户端
     * @param mixed $data 要返回的数据
     * @param array $headers 发送的Header信息
     * @return JsonResponse
     */
    protected function success($data, array $headers = []): JsonResponse
    {
        return response()->json([
            'code' => 0,
            'data' => $data,
        ], 200, $headers);
    }

    /**
     * 返回异常数据到客户端
     * @param string $message
     * @param int $code
     * @param array $headers
     * @return JsonResponse
     */
    protected function error(string $message = '', int $code = 400, array $headers = []): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
        ], 200, $headers);
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

    /**
     * @param $name
     * @param $value
     */
    protected function assign($name, $value): void
    {
        $this->vars = array_merge($this->vars, [$name => $value]);
    }
}
