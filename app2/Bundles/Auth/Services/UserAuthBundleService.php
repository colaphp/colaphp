<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

class UserAuthBundleService extends UserAuthService
{
    /**
     * 获取用户信息
     *
     * @throws CustomException
     */
    public function getUserByTypeAndIdentifier(UserAuthTypeEnum $userAuthType, string $identifier): array
    {
        if ($userAuthType !== UserAuthTypeEnum::Mobile) {
            throw new CustomException('当前仅支持手机号码登录');
        }

        $userService = new UserService();
        $user = $userService->getOne([
            ['mobile', '=', $identifier],
        ]);

        if (empty($user)) {
            return [];
        } elseif ($user['status'] !== UserStatusEnum::Normal->value) {
            throw new CustomException('用户状态不正常');
        }

        return $user;
    }

    /**
     * @throws CustomException
     */
    public function getUserAuth(UserEntity $userEntity, UserAuthTypeEnum $userAuthType, string $identifier): array
    {
        $result = $this->getOne([
            ['user_id', '=', $userEntity->getId()],
            ['type', '=', $userAuthType->value],
            ['identifier', '=', $identifier],
        ]);

        if (empty($result)) {
            return [];
        } elseif ($result['status'] !== UserAuthStatusEnum::Normal->value) {
            throw new CustomException('认证方式状态不正常');
        }

        return $result;
    }

    /**
     * 增加认证信息
     */
    public function createUserAuth(UserEntity $userEntity, UserAuthTypeEnum $type, string $identifier): bool
    {
        $userAuthEntity = new UserAuthEntity();
        $userAuthEntity->setUserId($userEntity->getId());
        $userAuthEntity->setUserUuid($userEntity->getUuid());
        $userAuthEntity->setType($type->value);
        $userAuthEntity->setIdentifier($identifier);
        $userAuthEntity->setStatus(UserAuthStatusEnum::Normal->value);

        $insertId = $this->insertGetId($userAuthEntity->toArray());

        return $insertId > 0;
    }

    /**
     * 根据用户ID查询认证列表
     */
    public function getAuthListByUserId(int $userId, UserAuthStatusEnum $status = UserAuthStatusEnum::Normal): array
    {
        $result = $this->getList([
            ['user_id', '=', $userId],
            ['status', '=', $status->value],
        ]);

        foreach ($result as $key => $item) {
            unset($item['credentials']);
            $result[$key] = $item;
        }

        return $result;
    }

    /**
     * 获取用户的认证类型
     */
    public function getAuthTypeByUserId(int $userId, UserAuthStatusEnum $status = UserAuthStatusEnum::Normal): array
    {
        $authList = $this->getAuthListByUserId($userId, $status);

        $data = [];
        foreach ($authList as $item) {
            $data[$item['type']] = $item['identifier'];
        }

        return $data;
    }
}
