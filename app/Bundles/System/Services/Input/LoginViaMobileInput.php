<?php

declare(strict_types=1);

namespace App\Bundles\System\Services\Input;

class LoginViaMobileInput
{
    /**
     * 登录手机号
     */
    private string $mobile;

    /**
     * 登录密码
     */
    private string $password;

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
