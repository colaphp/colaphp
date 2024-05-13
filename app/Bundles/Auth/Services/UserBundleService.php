<?php

declare(strict_types=1);

namespace App\Bundles\Auth\Services;

use Flame\Support\Str;
use Throwable;

class UserBundleService extends UserService
{
    /**
     * 创建用户
     *
     * @throws CustomException
     */
    public function createUser(AuthTypeEnum $userType, int $targetId, string $mobile): UserEntity
    {
        try {
            $userEntity = new UserEntity();
            $userEntity->setUuid(strval(Str::uuid()));
            $userEntity->setName(mobile_mask($mobile));
            $userEntity->setMobile($mobile);
            $userEntity->setStatus(UserStatusEnum::Normal->value);
            $userId = $this->insertGetId($userEntity->toArray());

            $userEntity->setId($userId);

            if ($userType === AuthTypeEnum::Driver) { // 司机
                $driverUserEntity = new DriverUserEntity();
                $driverUserEntity->setDriverId($targetId);
                $driverUserEntity->setUserId($userEntity->getId());

                $driverBundleService = new DriverBundleService();
                $driverBundleService->save($driverUserEntity->toArray());
            } elseif ($userType === AuthTypeEnum::Employee) { // 员工
                $employeeUserEntity = new EmployeeUserEntity();
                $employeeUserEntity->setEmployeeId($targetId);
                $employeeUserEntity->setUserId($userEntity->getId());

                $employeeBundleService = new EmployeeBundleService();
                $employeeBundleService->save($employeeUserEntity->toArray());
            } elseif ($userType === AuthTypeEnum::Passenger) { // 乘客
                $passengerUserEntity = new PassengerUserEntity();
                $passengerUserEntity->setPassengerId($targetId);
                $passengerUserEntity->setUserId($userEntity->getId());

                $passengerBundleService = new PassengerBundleService();
                $passengerBundleService->save($passengerUserEntity->toArray());
            }

            return $userEntity;
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
    }
}
