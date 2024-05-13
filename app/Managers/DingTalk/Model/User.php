<?php

declare(strict_types=1);

namespace App\Managers\DingTalk\Model;

use Flame\Support\ArrayHelper;

class User
{
    use ArrayHelper;

    /**
     * 员工的userId
     */
    private string $userId;

    /**
     * 员工在当前开发者企业账号范围内的唯一标识
     */
    private string $unionId;

    /**
     * 员工的直属主管
     */
    private string $managerUserId;

    /**
     * 员工姓名
     */
    private string $name;

    /**
     * 头像
     */
    private string $avatar;

    /**
     * 员工工号
     */
    private string $jobNumber;

    /**
     * 职位
     */
    private string $title;

    /**
     * 手机号码
     */
    private string $mobile;

    /**
     * 员工邮箱
     */
    private string $email;

    /**
     * 员工的企业邮箱
     */
    private string $orgEmail;

    /**
     * 备注
     */
    private string $remark;

    /**
     *所属部门id列表
     */
    private array $deptIdList;

    /**
     * 是否为企业的高管
     */
    private int $senior;

    /**
     * 是否为企业的管理员
     */
    private int $admin;

    /**
     * 是否为企业的老板
     */
    private int $boss;

    /**
     * 入职时间，Unix时间戳，单位毫秒
     */
    private string $hiredDate;

    /**
     * 是否激活了钉钉
     */
    private int $active;

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function getUnionId(): string
    {
        return $this->unionId;
    }

    public function setUnionId(string $unionId): void
    {
        $this->unionId = $unionId;
    }

    public function getManagerUserId(): string
    {
        return $this->managerUserId;
    }

    public function setManagerUserId(string $managerUserId): void
    {
        $this->managerUserId = $managerUserId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getJobNumber(): string
    {
        return $this->jobNumber;
    }

    public function setJobNumber(string $jobNumber): void
    {
        $this->jobNumber = $jobNumber;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getOrgEmail(): string
    {
        return $this->orgEmail;
    }

    public function setOrgEmail(string $orgEmail): void
    {
        $this->orgEmail = $orgEmail;
    }

    public function getRemark(): string
    {
        return $this->remark;
    }

    public function setRemark(string $remark): void
    {
        $this->remark = $remark;
    }

    public function getDeptIdList(): array
    {
        return $this->deptIdList;
    }

    public function setDeptIdList(array $deptIdList): void
    {
        $this->deptIdList = $deptIdList;
    }

    public function getSenior(): int
    {
        return $this->senior;
    }

    public function setSenior(int $senior): void
    {
        $this->senior = $senior;
    }

    public function getAdmin(): int
    {
        return $this->admin;
    }

    public function setAdmin(int $admin): void
    {
        $this->admin = $admin;
    }

    public function getBoss(): int
    {
        return $this->boss;
    }

    public function setBoss(int $boss): void
    {
        $this->boss = $boss;
    }

    public function getHiredDate(): string
    {
        return $this->hiredDate;
    }

    public function setHiredDate(string $hiredDate): void
    {
        $this->hiredDate = $hiredDate;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }
}
