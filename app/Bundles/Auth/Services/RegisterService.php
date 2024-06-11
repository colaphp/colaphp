<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use App\Service\Auth\Input\RegisterInput;
use Exception;
use Flame\Database\DB;

/**
 * Class RegisterService
 */
class RegisterService
{
    /**
     * 注册服务
     *
     *
     * @throws Exception
     */
    public function register(RegisterInput $registerInput, string $type): int
    {
        $condition = [];
        if ($type === 'username') {
            $condition[$type] = $registerInput->getUsername();
        } elseif ($type === 'email') {
            $condition[$type] = $registerInput->getEmail();
        } elseif ($type === 'mobile') {
            $condition[$type] = $registerInput->getMobile();
        }

        if (empty($condition)) {
            throw new Exception('注册类型异常');
        }

        $user = DB::table('ums_user')->where(key($condition), value($condition))->first();
        if (is_null($user)) {
            return DB::table('ums_user')->insertGetId(collect($registerInput)->toArray());
        }

        throw new Exception('注册信息已存在');
    }
}
