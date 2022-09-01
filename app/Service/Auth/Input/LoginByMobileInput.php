<?php

declare(strict_types=1);

namespace App\Service\Auth\Input;

class LoginByMobileInput
{
    /**
     * @var string
     */
    private string $mobile;

    /**
     * @var string
     */
    private string $smsCode;

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param  string  $mobile
     */
    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string
     */
    public function getSmsCode(): string
    {
        return $this->smsCode;
    }

    /**
     * @param  string  $smsCode
     */
    public function setSmsCode(string $smsCode): void
    {
        $this->smsCode = $smsCode;
    }
}
