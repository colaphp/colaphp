<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use Exception;

class DingTalkBundleService
{
    /**
     * 扫码登录
     *
     * @throws Exception
     */
    public function scan(string $code): array
    {
        $userManager = new UserManager();
        $userAccessToken = $userManager->getUserAccessToken($code);
        $userInfo = $userManager->getContactUser($userAccessToken);
        $userId = $userManager->getUserIdByUnionId($userInfo['unionId']);

        return $this->auth($userInfo['mobile'], $userId, $userInfo['unionId']);
    }

    /**
     * 应用内免登
     *
     * @throws Exception
     */
    public function silent(string $code): array
    {
        // https://open.dingtalk.com/document/orgapp/obtain-the-userid-of-a-user-by-using-the-log-free
        $userManager = new UserManager();
        $dingTalkUser = $userManager->getUserByCode($code);

        return $this->auth($dingTalkUser->getMobile(), $dingTalkUser->getUserId(), $dingTalkUser->getUnionId());
    }

    /**
     * @throws Exception
     */
    private function auth(string $mobile, string $userId, string $unionId = ''): array
    {
        $userAuthBundleService = new UserAuthBundleService();
        $employeeBundleService = new EmployeeBundleService();
        $userBundleService = new UserBundleService();

        // 查询远程钉钉员工信息
        $employee = $employeeBundleService->getEmployeeByRPC(['user_id' => $userId]);

        // 查询本地用户信息
        $user = $userAuthBundleService->getUserByTypeAndIdentifier(UserAuthTypeEnum::Mobile, $mobile);
        if (empty($user)) {
            $userEntity = $userBundleService->createUser(AuthTypeEnum::Employee, $employee['id'], $mobile);
        } else {
            $userEntity = new UserEntity();
            $userEntity->setData($user);
        }

        // 查询钉钉用户认证信息
        $userIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::DingTalkUserId, $userId);
        if (empty($userIdAuth)) {
            $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::DingTalkUserId, $userId);
        }

        if (! empty($unionId)) {
            // 查询钉钉用户认证信息
            $unionIdAuth = $userAuthBundleService->getUserAuth($userEntity, UserAuthTypeEnum::DingTalkUnionId, $unionId);
            if (empty($unionIdAuth)) {
                $userAuthBundleService->createUserAuth($userEntity, UserAuthTypeEnum::DingTalkUnionId, $unionId);
            }
        }

        return $employee;
    }
}
