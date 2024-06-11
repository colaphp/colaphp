<?php

declare(strict_types=1);

namespace App\API\Common\Controllers;

use Flame\Foundation\Exception\CustomException;
use Flame\Http\Request;
use Flame\Http\Response;
use Flame\Support\Str;
use Throwable;

/**
 * JSON RPC 服务
 */
class RpcController extends BaseController
{
    public function index(Request $request): Response
    {
        $request = json_decode($request->rawBody(), true);

        try {
            if (isset($request['method'])) {
                [$procedure, $method] = explode('@', $request['method']);

                $producer = '\\App\\Procedures\\'.Str::studly($procedure).'Procedure';
                if (class_exists($producer)) {
                    $request['method'] = $method;
                    $result = (new $producer())->handle($request);

                    return json($result);
                }
            }

            throw new CustomException('没有找到 JSON RPC 服务');
        } catch (Throwable $e) {
            return json([
                'jsonrpc' => '2.0',
                'id' => $request['id'] ?? null,
                'error' => ['code' => $e->getCode(), 'message' => $e->getMessage()],
            ]);
        }
    }
}
