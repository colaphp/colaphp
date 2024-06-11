<?php

declare(strict_types=1);

namespace App\Service\Auth\Input;

class LoginByMobileInput
{
    private string $mobile;

    private string $smsCode;

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getSmsCode(): string
    {
        return $this->smsCode;
    }

    public function setSmsCode(string $smsCode): void
    {
        $this->smsCode = $smsCode;
    }
}
