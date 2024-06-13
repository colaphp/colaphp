<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use Exception;
use Flame\JsonRpc\JsonRpcClient;

class AdminBundleService
{
    /**
     * 获取员工ID
     */
    public function getEmployeeIdByUserId(int $userId): int
    {
        $employeeId = $this->value('employee_id', ['user_id' => $userId]);

        return empty($employeeId) ? 0 : $employeeId;
    }

    /**
     * 增加员工信息（RPC）
     *
     * @throws Exception
     */
    public function createEmployeeByRPC(array $employee): array
    {
        $config = config('jsonrpc');

        $jsonRpcClient = new JsonRpcClient($config['endpoint']['employee']);

        return $jsonRpcClient->call('employee@create', $employee);
    }

    /**
     * 获取员工信息（RPC）
     *
     * @throws Exception
     */
    public function getEmployeeByIdRPC(int $employeeId): array
    {
        $config = config('jsonrpc');

        $jsonRpcClient = new JsonRpcClient($config['endpoint']['employee']);

        return $jsonRpcClient->call('employee@show', ['id' => $employeeId]);
    }

    /**
     * 获取员工信息（RPC）
     *
     * @throws Exception
     */
    public function getEmployeeByRPC(array $condition): array
    {
        $config = config('jsonrpc');

        $jsonRpcClient = new JsonRpcClient($config['endpoint']['employee']);

        return $jsonRpcClient->call('employee@show', $condition);
    }
}
